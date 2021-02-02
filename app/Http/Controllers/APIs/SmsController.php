<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SMSProvider;
use App\Models\SmsVerfication;
use App\Models\Client;
use App\Models\TempClient;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    use APIResponseTrait;
    protected $duraion = 15;
    public function sendMessage(Request $request)
    {
        $SmsProvider = new SMSProvider();
        $code = rand(1000, 9999); //generate random code
        $request['code'] = $code; //add code in $request body

        $smsVerifcation = SmsVerfication::where('contact_number', '=',
            $request->contact_number)->where('created_at', '>=', Carbon::now()->subMinutes($this->duraion)->toDateTimeString())->latest()->first();

        // return $smsVerifcation ;
        if ($smsVerifcation != null) {
            return $this->APIResponse(null, "the code has been sent", 400);
        } else {
            $smsVerifcation = SmsVerfication::where('contact_number', '=', $request->contact_number);
            $smsVerifcation->delete();
        }

        SmsVerfication::create($request->all());
        if ($SmsProvider->sendMessage(request('contact_number'), $code)) {
            return $this->APIResponse(null, null, 201);
        } else {
            return $this->APIResponse(null, "error with sms provider", 400);
        }

    }
    public function verifyContact(Request $request)
    {
        $smsVerification = SmsVerfication::where('contact_number', '=',
            $request->contact_number)->latest()->first(); //show the latest if there are multiple

        if ($smsVerification != null )
        {
            if ( $request->code == $smsVerification->code) {

                $smsVerifyed = SmsVerfication::where('contact_number', '=',
                    $request->contact_number)->where('created_at', '>=', Carbon::now()->subMinutes(15)->toDateTimeString())->latest()->first();

                if (isset($smsVerifyed)) {
                    $tempClient = TempClient::where('phone', $request->contact_number)->first();
                    $client = Client::create($tempClient->toArray());
                    $tempClient->delete();
                    $request['token'] = $client->createToken('token')->accessToken;
                    $request["status"] = 'verified';
                    $smsVerifyed->update($request->all());
                    return $this->APIResponse( $request['token'], null, 201);
                } else {
                    \DB::beginTransaction();
                    $smsVerification->delete();
                    $client = Client::where('phone', $request->contact_number)->first();
                    SmsVerfication::where('contact_number', $request->contact_number)->delete();
                    $token = $client->createToken('token')->accessToken;
                    $smsCode = rand(10000,100000);
                    $clientRequest = new \GuzzleHttp\Client();
                    $requestData = [
                        "username"=> env('SMSEG_USERNAME'),
                        "password"=> env('SMSEG_PASSWORD'),
                        "sendername"=> env('SMSEG_SENDERNAME'),
                        "mobiles"=> "2" . $client->phone,
                        "message"=> $smsCode
                    ];
                    $response = $clientRequest->post('https://smssmartegypt.com/sms/api/json/', ['json' => $requestData]);
                    $responseData = json_decode($response->getBody(), true);
                    if(isset($responseData[0])){
                        $smsVerfication = SmsVerfication::create([
                            'contact_number' => $client->phone,
                            'code' => $smsCode]);
                        \DB::commit();
                    }
                    else{
                        \DB::rollBack();
                        return $this->APIResponse("User can't create", null, 400);
                    }
                    return $this->APIResponse($token, "This code is expired, please confirm new code", 400);
                }
            } else {
                return $this->APIResponse(null, "not verified", 400);
            }
        }
        else
        {
            return $this->APIResponse(null, "not founded", 400);
        }
    }
    public function sendMessageToPhone($phone)
    {

        return true;
    }
}
