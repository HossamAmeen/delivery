<?php

namespace App\Http\Controllers\APIs;
use App\Http\Controllers\APIResponseTrait;
use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class DeliveryController extends Controller
{
    use APIResponseTrait;
    public function login()
    {
        $credentials = request(['phone', 'password']);

        if(!Auth::guard('delivery')->attempt($credentials, false, false)){
            $error = "Unauthorized";
            return $this->APIResponse(null, $error, 400);
        }
        $delivery = Delivery::where("phone", request('phone'))->first();
        auth()->login($delivery);
      //  return Auth::guard('client')->user()->id;
        $success['token'] =  $delivery->createToken('token')->accessToken;
        return $this->APIResponse($success, null, 200);
    }
    public function orders()
    {
        $orders = Order::where('delivery_id' , Auth::guard('delivery-api')->user()->id)
        ->get();

        return $this->APIResponse($orders, null, 201);
    }
}
