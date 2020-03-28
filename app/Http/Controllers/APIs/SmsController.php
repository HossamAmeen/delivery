<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SMSProvider;
use App\Models\SmsVerfication;
use App\Models\Client;
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
        // request('phone')
        $smsVerifcation = SmsVerfication::where('contact_number', '=',
            $request->contact_number)->latest()->first(); //show the latest if there are multiple
        
        if ($smsVerifcation != null )
        {
            if ( $request->code == $smsVerifcation->code) {

                $smsVerifcation = SmsVerfication::where('contact_number', '=',
                    $request->contact_number)->where('created_at', '>=', Carbon::now()->subMinutes(15)->toDateTimeString())->latest()->first();
    
                if (isset($smsVerifcation)) {
                    $request["status"] = 'verified';
                    $client = new Client();
                //   return   $client->createToken('token')->accessToken;
                $request['token'] = $client->createToken('token')->accessToken ; 
                    $smsVerifcation->update($request->all());
                    return $this->APIResponse( $request['token'], null, 201);
                } else {
                    return $this->APIResponse(null, "code is expired", 400);
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
