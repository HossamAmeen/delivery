<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Delivery;
use App\Models\Client;

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
        if(!empty($with)){
            $rows = $rows->with($with);
        }
        $status = $request->status ; 
        $rows = $rows->orderBy('id', 'DESC')->where('status' ,  $request->status)->get();
        $moduleName = $this->pluralModelName();
        $sModuleName = $this->getModelName();
        $routeName = $this->getClassNameFromModel();

        $pageTitle = ""; $pageTitle = ""; $pageTitle = ""; $pageTitle = ""; $pageTitle = "";
        $pageDes = "Here you can add / edit / delete " .$moduleName;
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

    public function changeStatus($status , $orderId , $deliveryId = null)
    {
        $order = Order::find($orderId);
        $order->status = $status;
        $order->save();
        if($status == 5)
        {
            $delivery = Delivery::find($deliveryId);
            if(isset($delivery))
            {
                $delivery->money = $order->delivery_price;
                $delivery->save();
                // return $delivery;
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
        $this->model->create($request->all());
        return redirect()->route("show-orders" ,  1);
        return redirect()->route($this->getClassNameFromModel().'.index');
    }

    public function update(Request $request, $id)
    {
      $this->model::find($id)->update($request->all());

        return redirect()->route($this->getClassNameFromModel().'.index');
    }

    public function append()
    {
        $data['deliveries'] = Delivery::orderBy('id', 'DESC')->get();
        $data['clients'] = Client::orderBy('id', 'DESC')->get();
      
        return  $data ; 
    }
}
