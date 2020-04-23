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

    public function show(Request $request)
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
            'routeName'
        ));
    }

    public function changeStatus($status, $orderId, $deliveryId = null)
    {
        $order = Order::find($orderId);
        $order->status = $status;
        $order->save();
        if ($status == 5) {
            $delivery = Delivery::find($order->delivery_id);
            if (isset($delivery)) {
                // return  ( $order->delivery_price * $delivery->delivery_ratio )  / 100 ;
                $delivery->money += ($order->delivery_price * $delivery->delivery_ratio) / 100;
                // return $delivery->money ;
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
    public function destroy($id)
    {
        $this->model->FindOrFail($id)->delete();
        session()->flash('action', 'تم الحذف بنجاح');
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $order = $this->model->create($request->all());
        if (isset($request->delivery_id)) {
            $this->sendToFirebase($request->delivery_id);
        }
        if ($order->status == 5) {
            $delivery = Delivery::find($order->delivery_id);
            if (isset($delivery)) {

                // return  ( $order->delivery_price * $delivery->delivery_ratio )  / 100 ;
                $delivery->money += ($order->delivery_price * $delivery->delivery_ratio) / 100;
                // return $delivery->money ;
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
        $order = $this->model::find($id);
        $order->update($request->all());
        if (isset($request->delivery_id)) {
            $this->sendToFirebase($request->delivery_id);
        }
        if ($order->status == 5) {
            $delivery = Delivery::find($order->delivery_id);
            if (isset($delivery)) {

                // return  ( $order->delivery_price * $delivery->delivery_ratio )  / 100 ;
                $delivery->money += ($order->delivery_price * $delivery->delivery_ratio) / 100;
                // return $delivery->money ;
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

    }

    public function append()
    {
        $data['deliveries'] = Delivery::orderBy('id', 'DESC')->get();
        $data['clients'] = Client::orderBy('id', 'DESC')->get();

        return $data;
    }

    public function sendToFirebase($deliveryId)
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
        $snapshot[$deliveryId] = 1;
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

    static function  notificationToClient($clinetId , $orderID , $orderstatus)
    {
         // return __DIR__ ;
         $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/delivery-e3e58-firebase-adminsdk-imo2m-b7f0400810.json');
         $firebase = (new Factory)
             ->withServiceAccount($serviceAccount)
             ->withDatabaseUri('https://delivery-e3e58.firebaseio.com/')
             ->create();
         $database = $firebase->getDatabase();
         $reference = $database->getReference('/deliveries');

         $snapshot = $reference->getSnapshot()->getValue();

         $snapshot[1] =9;
         $newPost = $database
             ->getReference('/deliveries')
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
