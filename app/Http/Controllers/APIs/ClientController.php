<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;

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
        $client = Client::where('phone' ,request('phone'))->first();
        if($client){
            return $this->APIResponse(null, 'هذا الرقم مسجل من قبل', 400);
        }
        $client = Client::where('email' ,request('email'))->first();
        if($client){
            return $this->APIResponse(null, 'هذا البريد مسجل من قبل', 400);
        }
        
        $this->sendMessage(request('phone'));
        if (isset($request->password)) {
            $request['password'] = bcrypt($request->password);
        }

        $client = Client::create($request->all());
        $success['token'] = $client->createToken('token')->accessToken;
        // $smsVerfication->delete();
        return $this->APIResponse($success, null, 200);

    }

    public function login(Request $request)
    {
        $field = 'phone';

        if (is_numeric($request->input('phone'))) {
            $field = 'phone';
        } elseif (filter_var($request->input('phone'), FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        }

        $request->merge([$field => $request->input('phone')]);

        if (!Auth::guard('client')->attempt($request->only($field, 'password'))) {
            $error = "Unauthorized";
            return $this->APIResponse(null, $error, 400);
        }
        $client = Client::where($field, request('phone'))->first();

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
        Client::find(Auth::guard('client-api')->user()->id)->update($request->all());
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

    public function sendSMSCode($phone)
    {
        $smsVerifcation = SmsVerfication::where('contact_number', '=',
        $request->contact_number)->where('created_at', '>=', Carbon::now()->subMinutes($this->duraion)->toDateTimeString())->latest()->first();

        if ($smsVerifcation != null) {
            return $this->APIResponse(null, "the code has been sent", 400);
        } else {
            $smsVerifcation = SmsVerfication::where('contact_number', '=', $request->contact_number);
            $smsVerifcation->delete();
        }
    }

}
