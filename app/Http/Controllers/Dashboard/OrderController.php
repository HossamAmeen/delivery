<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Client;
use App\Models\Delivery;
use App\Models\Order;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class OrderController extends BackEndController
{
    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function show(Request $request  , $delevry_id)
    {

        $rows = $this->model;
        $rows = $this->filter($rows);
        $with = $this->with();
        if (!empty($with)) {
            $rows = $rows->with($with);
        }
        $status = $request->status;
        $rows = $rows->orderBy('id', 'DESC')->where('status', $request->status)->get();
        $moduleName = $this->pluralModelName();
        $sModuleName = $this->getModelName();
        $routeName = $this->getClassNameFromModel();


        $pageTitle = "";
        $pageDes = "Here you can add / edit / delete " . $moduleName;
        // return $rows;
        // return Auth::user()->role;
       
        return view('back-end.' . $routeName . '.index', compact(
            'rows',
           'status',
            'pageTitle',
            'moduleName',
            'pageDes',
            'sModuleName',
            'routeName',
            
        ));
    }

    public function showOrderWithDelivery(Request $request  , $delevry_id)
    {
        $rows = $this->model;
        $rows = $this->filter($rows);
        $with = $this->with();
        if (!empty($with)) {
            $rows = $rows->with($with);
        }
        $delevry = Delivery::findOrFail($delevry_id);
        $delivery_name = $delevry->name;
        $rows = $rows->orderBy('id', 'DESC')->where('delivery_id', $delevry_id)->get();
        $moduleName = $this->pluralModelName();
        $sModuleName = $this->getModelName();
        $routeName = $this->getClassNameFromModel();


        $pageTitle = "";
        $pageDes = "Here you can add / edit / delete " . $moduleName;
        // return $rows;
        // return Auth::user()->role;
       
        return view('back-end.' . $routeName . '.index-for-delivery', compact(
            'rows',
           
            'pageTitle',
            'moduleName',
            'pageDes',
            'sModuleName',
            'routeName',
            'delivery_name'
        ));
    }
    public function changeStatus($status, $orderId, $deliveryId = null)
    {
        $order = Order::find($orderId);
        $order->status = $status;
        $order->save();
        $this::notificationToClient($order->client_id , $order->id ,  $order->status , true);
        if ($status == 5) {
            $delivery = Delivery::find($order->delivery_id);
            if (isset($delivery)) {
                // return  ( $order->delivery_price * $delivery->delivery_ratio )  / 100 ;
                $delivery->money += ($order->delivery_price * $delivery->delivery_ratio) / 100;
                // return $delivery->money ;
                $delivery->status = "متاح";
                $delivery->save();

                $order->delivery_ratio = ($order->delivery_price * $delivery->delivery_ratio) / 100;
                $order->save();
                // return $delivery;
            }
            if ($order->price < 0) {
                $client = Client::find($order->client_id);
                if (isset($client)) {
                    $client->money -= $order->price;
                    $client->save();
                }
            }

        }
        return redirect()->back();
    }
    public function destroy( $id)
    {
        $order = $this->model->FindOrFail($id);
        $delivery = Delivery::find($order->delivery_id);
        if (isset($delivery)) {
            $delivery->status = "مشغول";
            $delivery->save();
            $this->sendToFirebase($order->delivery_id);
        }
        $order ->delete();
        session()->flash('action', 'تم الحذف بنجاح');
        return redirect()->back();
    }
    public function store(Request $request)
    {
        if( $request->client_id == null){
            return back()->withErrors(['يجب اختيار عميل ']);
        } 
        // return $request->all();
        $order = $this->model->create($request->all());
        $this::notificationToClient($order->client_id , $order->id ,1);
        if (isset($request->delivery_id)) {
            $delivery = Delivery::find($order->delivery_id);
            if (isset($delivery)) {
                $delivery->status = "مشغول";
                $delivery->save();
                $this->sendToFirebase($request->delivery_id);
            }

        }
        if ($order->status == 5) {
            $delivery = Delivery::find($order->delivery_id);
            if (isset($delivery)) {

                // return  ( $order->delivery_price * $delivery->delivery_ratio )  / 100 ;
                $delivery->money += ($order->delivery_price * $delivery->delivery_ratio) / 100;
                // return $delivery->money ;
                $delivery->status = "متاح";
                $delivery->save();
                $order->delivery_ratio = ($order->delivery_price * $delivery->delivery_ratio) / 100;
                $order->save();
                // return $delivery;
            }
            if ($order->price < 0) {
                $client = Client::find($order->client_id);
                if (isset($client)) {
                    $client->money -= $order->price;
                    $client->save();
                }
            }

        }
        return redirect()->route("show-orders", $order->status);
        return redirect()->route($this->getClassNameFromModel() . '.index');
    }

    public function update(Request $request, $id)
    {
        $isDeliveryChange= false;$isStatusChange= false;
        if( $request->client_id == null){
            return back()->withErrors(['يجب اختيار عميل ']);
        } 
        $order = $this->model::find($id);
        if(isset($request->delivery_id) && $order->delivery_id == null){
            // return "test";
            $isDeliveryChange = true;
            // $this::notificationToClient($order->client_id , $order->id ,  $request->status );
        }
        elseif($order->status != $request->status)
        {
            $isStatusChange = true;
            // $this::notificationToClient($order->client_id , $order->id ,  $request->status , true);
        }
        else{
            return "test2";
        }
        $order->update($request->all());
        if($isDeliveryChange == true){
            $this::notificationToClient($order->client_id , $order->id ,  $request->status );
        }
        elseif($isStatusChange==true)
        {
              $this::notificationToClient($order->client_id , $order->id ,  $request->status , true );
        }
        if (isset($request->delivery_id)) {
                $delivery = Delivery::find($order->delivery_id);
                if (isset($delivery)) {
                    $delivery->status = "مشغول";
                    $delivery->save();
                    $this->sendToFirebase($request->delivery_id);
                }
                // 
            // $this->sendToFirebase($request->delivery_id);
        }
        else
        {

                $delivery = Delivery::find($order->delivery_id);
                if (isset($delivery)) {
                    $delivery->status = "متاح";
                    $delivery->save();
                    $this->sendToFirebase($request->delivery_id);
                }
                // $this::notificationToClient($order->client_id , $order->id ,  $order->status , true);

        }
        if ($order->status == 5) {
            $delivery = Delivery::find($order->delivery_id);
            if (isset($delivery)) {

                // return  ( $order->delivery_price * $delivery->delivery_ratio )  / 100 ;
                $delivery->money += ($order->delivery_price * $delivery->delivery_ratio) / 100;
                // return $delivery->money ;
                $delivery->status = "متاح";
                $delivery->save();
                $order->delivery_ratio = ($order->delivery_price * $delivery->delivery_ratio) / 100;
                $order->save();
                // return $delivery;
                $this->sendToFirebase($request->delivery_id , 0);
            }
            if ($order->price < 0) {
                $client = Client::find($order->client_id);
                if (isset($client)) {
                    $client->money -= $order->price;
                    $client->save();
                }
            }

        }
        return redirect()->route("show-orders", $order->status);

    }

    public function append()
    {
        $data['deliveries'] = Delivery::orderBy('status')->get();
        $data['clients'] = Client::orderBy('id', 'DESC')->get();

        return $data;
    }

    public function sendToFirebase($deliveryId , $status = 1 )
    {
        // return __DIR__ ;
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/delivery-e3e58-firebase-adminsdk-imo2m-b7f0400810.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://delivery-e3e58.firebaseio.com/')
            ->create();

        $database = $firebase->getDatabase();

        // $database->getReference('/deliveries') // this is the root reference
        // ->update(['1' => 55 ]);

        $reference = $database->getReference('/deliveries');

        $snapshot = $reference->getSnapshot()->getValue();
        //    return  $snapshot;
        // $ids =   $database->getReference('/deliveries')->getChildKeys();

        // return  $database->getReference('/deliveries')->getChildKeys();

        // $database->getReference('deliveries')->remove();
        $snapshot[$deliveryId] = $status;
        $newPost = $database
            ->getReference('/deliveries')
            ->update($snapshot);

        // return $database->getChild() ;
        // $newPost = $database
        // ->getReference('/')
        // ->push([
        //     $id => $id2
        // ]);

        //   echo '<pre>';
        //   print_r($newPost->getvalue() );
    }

    static function  notificationToClient($clinetId , $orderID , $orderstatus , $changeStatus = false)
    {
         // return __DIR__ ;
         $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/delivery-e3e58-firebase-adminsdk-imo2m-b7f0400810.json');
         $firebase = (new Factory)
             ->withServiceAccount($serviceAccount)
             ->withDatabaseUri('https://delivery-e3e58.firebaseio.com/')
             ->create();
         $database = $firebase->getDatabase();
         $reference = $database->getReference('/clients');

         $snapshot = $reference->getSnapshot()->getValue();

        //  $snapshot[$clinetId] ="$orderstatus". '-'."$orderID";
         $order =  Order::find($orderID);
         if($changeStatus == true){
            $snapshot[$clinetId] = $orderstatus."-".$orderID."-";
          }
        else
         {
            $snapshot[$clinetId] = $orderstatus."-".$orderID."-".$order->delivery->name ??  "";
         }
         $newPost = $database->getReference('/clients')
                             ->update($snapshot);
    }

    public function orderCount()
    {
        $NewOrderCount = Order::where('status',1)->count();

        return response()->json([
            'NewOrderCount' => $NewOrderCount,
        ]);
    }
}
