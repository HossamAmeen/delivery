<?php

namespace App\Http\Controllers\APIs;
use App\Http\Controllers\APIResponseTrait;
use App\Http\Controllers\Dashboard\OrderController;
use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class DeliveryController extends Controller
{
    use APIResponseTrait ;
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
        ->with(['client', 'images'])
        ->orderBy('id', 'DESC')
        ->get();

        return $this->APIResponse($orders, null, 201);
    }

    public function lastOrder()
    {
        $orders = Order::latest()
        ->where('delivery_id' , Auth::guard('delivery-api')->user()->id)
        ->with('client')
        ->orderBy('id', 'DESC')
        ->first();
        return $this->APIResponse($orders, null, 201);
    }
    public function orderDelivered()
    {
        $orders = Order::latest()
        ->where('delivery_id' , Auth::guard('delivery-api')->user()->id)
        ->where('status' , 5)
        ->with('client')
        ->orderBy('id', 'DESC')
        ->first();
        return $this->APIResponse($orders, null, 201);
    }

    public function changeStatus($orderId)
    {
        $order = Order::find($orderId);

        if(isset($order)){

            $order->status = 5;
            $order->save();

            $delivery = Delivery::find($order->delivery_id);
            if(isset($delivery))
            {
                // return  ( $order->delivery_price * $delivery->delivery_ratio )  / 100 ;
                $delivery->money += ( $order->delivery_price * $delivery->delivery_ratio )  / 100 ;
                // return $delivery->money ;
                $delivery->save();
                // return $delivery;
            }
            if($order->price < 0 ){
                $client = Client::find($order->client_id);
                if(isset($client))
                {
                    $client->money -= $order->price ;
                    $client->save();

                }
                else
                return $this->APIResponse(null, "this client in not found for this order", 201);
            }
        //    $oredercon = new OrderController();

            OrderController::notificationToClient($order->client_id , $order->id ,  5);
            return $this->APIResponse(null, null, 201);
        }
        return $this->APIResponse(null, "not found this order", 201);


    }
}
