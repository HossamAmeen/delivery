<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;
use App\Models\TempClient;

use App\Models\SmsVerfication;
use Auth;
use Illuminate\Http\Request;
use Image;

class ClientController extends Controller
{
    use APIResponseTrait;

    // public function register(ClientRequest $request)
    public function register(Request $request)
    {
        \DB::beginTransaction();
        $client = Client::where('phone', $request->phone)->latest()->first();
        if($client){
            if($client->user_id){
                if (isset($request->password)) {
                    $request['password'] = bcrypt($request->password);
                }
                $client->update($request->all());
            }
            else
                return $this->APIResponse(null, 'This account already exist.', 400);
        }
        else{
            $tempClient = TempClient::where('phone', $request->phone)->latest()->first();
            if(empty($tempClient)){
                if (isset($request->password)) {
                    $request['password'] = bcrypt($request->password);
                }
                $client = TempClient::create($request->all());
            }
            else
                $client = $tempClient;
        }
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
            SmsVerfication::where('contact_number', $client->phone)->delete();
            $smsVerfication = SmsVerfication::create([
                'contact_number' => $client->phone,
                'code' => $smsCode]);
            \DB::commit();
        }
        else{
            \DB::rollBack();
            return $this->APIResponse("User can't create", null, 400);
        }
        return $this->APIResponse("Please check your phone messages.", null, 200);













        // \DB::beginTransaction();

        // $client = Client::where('phone', $request->phone)->latest()->first();
        // if($client){
        //     $smsVerfication = SmsVerfication::where('contact_number', $request->phone)->latest()->first();
        //     if($smsVerfication){
        //         if($smsVerfication->status == 'verified')
        //             return $this->APIResponse(null, 'This account already exist.', 400);
        //         $smsVerfication->delete();
        //     }
        //     elseif($client->user_id){
        //         if (isset($request->password)) {
        //             $request['password'] = bcrypt($request->password);
        //         }
        //         $client->update($request->all());
        //     }
        // }
        // else{
        //     if (isset($request->password)) {
        //         $request['password'] = bcrypt($request->password);
        //     }
        //     $client = Client::create($request->all());
        // }
        // $success['token'] = $client->createToken('token')->accessToken;
        // $smsCode = rand(10000,100000);
        // $clientRequest = new \GuzzleHttp\Client();
        // $requestData = [
        //     "username"=> env('SMSEG_USERNAME'),
        //     "password"=> env('SMSEG_PASSWORD'),
        //     "sendername"=> env('SMSEG_SENDERNAME'),
        //     "mobiles"=> "2" . $client->phone,
        //     "message"=> $smsCode
        // ];
        // $response = $clientRequest->post('https://smssmartegypt.com/sms/api/json/', ['json' => $requestData]);
        // $responseData = json_decode($response->getBody(), true);
        // if(isset($responseData[0])){
        //     $smsVerfication = SmsVerfication::create([
        //         'contact_number' => $client->phone,
        //         'code' => $smsCode]);
        //     \DB::commit();
        // }
        // else{
        //     \DB::rollBack();
        //     return $this->APIResponse("User can't create", null, 400);
        // }
        // // $smsVerfication->delete();
        // return $this->APIResponse($success, null, 200);
    }

    public function login(Request $request)
    {
        $field = 'phone';

        if (is_numeric($request->input('phone'))) {
            $filterField = $request->input('phone');
            $field = 'phone';
        } elseif (filter_var($request->input('phone'), FILTER_VALIDATE_EMAIL)) {
            $filterField = filter_var($request->input('phone'), FILTER_VALIDATE_EMAIL);
            $field = 'email';
        }

        $request->merge([$field => $request->input('phone')]);

        if (!Auth::guard('client')->attempt($request->only($field, 'password'))) {
            $error = "Unauthorized";
            return $this->APIResponse(null, $error, 400);
        }
        $client = Client::where($field, $filterField)->first();
        if($client->created_at > "2020-11-11")
        {
            $clientCheck = SmsVerfication::where('contact_number', $client->phone)->where('status', 'verified')->first();
            if(empty($clientCheck))
                return $this->APIResponse("This user doesn't verified", null, 400);
        }
        $success['token'] = $client->createToken('token')->accessToken;
        return $this->APIResponse($success, null, 200);

    }
    public function loginWithGmail()
    {
        if (request('password') != "Delivery@2019To2020#") {
            return $this->APIResponse(null, "Unauthorized", 400);
        }
        $client = Client::where('google_id', request('account_id'))->first();

        if (isset($client)) {
            $success['token'] = $client->createToken('token')->accessToken;
            return $this->APIResponse($success, null, 200);
        } else {
            return $this->APIResponse(null, "not found", 404);
        }

    }
    public function loginStudy(Request $request)
    {
        $credentials = request(['phone', 'password']);

        if (!Auth::guard('client')->attempt($credentials, false, false)) {
            $error = "Unauthorized";
            return $this->APIResponse(null, $error, 400);
        }
        $client = Client::where("phone", request('phone'))->first();
        auth()->login($client);
        //  return Auth::guard('client')->user()->id;
        $success['token'] = $client->createToken('token')->accessToken;
        return $this->APIResponse($success, null, 200);
        return response()->json($success, 200);
    }

    public function checkEmail()
    {
        $client = Client::where('email', request('email'))->first();
        if (isset($client)) {
            return $this->APIResponse(null, null, 201);
        } else {
            return $this->APIResponse(null, "not found", 404);
        }

    }
    public function getAccount()
    {
        $client = Client::findOrFail(Auth::guard('client-api')->user()->id);
        return $this->APIResponse($client, null, 201);
    }
    public function updateAccount(Request $request)
    {
        $client = Client::find(Auth::guard('client-api')->user()->id);
        $request->merge([
            'phone' => $client->phone,
            'phone2' => $client->phone2
            ]);
        $client->update($request->all());
        return $this->APIResponse(null, null, 201);

    }
    public function showOrders()
    {
        $order = Order::where('client_id', Auth::guard('client-api')->user()->id)
            ->with('delivery')
            ->get();

        return $this->APIResponse($order, null, 201);
    }

    public function addOrder(Request $request)
    {
        $request['client_id'] = Auth::guard('client-api')->user()->id;
        $order = Order::create($request->all());
        // return $order->delivery->name ??  "لا يوجد" ;
        OrderController::notificationToClient($order->client_id , $order->id ,1);
        if ($request->image) {
            $this->uploadImages($request, $order->id);
        }

        return $this->APIResponse( $request->all(), null, 201);
    }

    public function addRate(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->rate = $request->rate;
        $order->review = $request->review;
        $order->save();

        return $this->APIResponse(null, null, 201);
    }

    protected function uploadImages($request, $orderId)
    {

        $photos = $request->file('image');

        foreach ($photos as $photo) {
            $fileName = time() . str_random('10') . '.' . $photo->getClientOriginalExtension();
            $destinationPath = ('uploads/orders/');
            // $image = Image::make($photo->getRealPath())->resize($height, $width);
            $image = Image::make($photo->getRealPath());
            // return $destinationPath;

            if (!is_dir($destinationPath)) {
                mkdir($destinationPath);
            }
            $image->save($destinationPath . $fileName);

            \App\Models\ImagesOrder::create([
                'image' => 'uploads/orders/' . $fileName,
                'order_id' => $orderId,
            ]);
        }
    }

}
