<?php

namespace App\Http\Controllers\APIs;
use App\Http\Controllers\APIResponseTrait;
use App\Models\Client;
use App\Models\Order;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    use APIResponseTrait;
    // public function register(ClientRequest $request)
    public function register(Request $request)
    {
        // if (isset($request->validator) && $request->validator->fails())
        // {
        //     return $this->APIResponse(null , $request->validator->messages() ,  400);
        // }
        // return $request->password;
        $request['password'] = bcrypt($request->password);
        $client = Client::create($request->all());
        auth()->login($client);
        $success['token'] =  $client->createToken('token')->accessToken;

       
        return response()->json($success, 200);
    }

    public function login()
    {
        $credentials = request(['phone', 'password']);

        if(!Auth::guard('client')->attempt($credentials, false, false)){
            $error = "Unauthorized";
            return $this->APIResponse(null, $error, 400);
        }
        $client = Client::where("phone", request('phone'))->first();
        $success['token'] =  $client->createToken('token')->accessToken;
        return response()->json($success, 200);

    }

    public function getAccount()
    {
        $client = Client::findOrFail(Auth::guard('client-api')->user()->id);
        return $this->APIResponse($client, null, 201);
    }
    public function showOrders()
    {
        $order = Order::where('client_id' , Auth::guard('client-api')->user()->id)
        ->get();

        return $this->APIResponse($order, null, 201);
    }
    
    public function addOrder(Request $request)
    {
        $request['client_id'] = Auth::guard('client-api')->user()->id;
        Order::create($request->all());
        return $this->APIResponse(null, null, 201);
    }

    public function addRate(Request $request , $id)
    {
        $order = Order::findOrFail($id);
        $order->rate =  $request->rate ;
        $order->review =  $request->review ; 
        $order->save();
       
        return $this->APIResponse(null, null, 201);
    }
}
