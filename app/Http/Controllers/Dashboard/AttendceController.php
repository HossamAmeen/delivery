<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendce;
use App\Models\Delivery;

class AttendceController extends BackEndController
{
    public function __construct(Attendce $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {

        $this->model->create($request->all());

        return redirect()->route($this->getClassNameFromModel().'.index');
    }

    public function update(Request $request, $id)
    {
      $item = $this->model::find($id);
      $item->update($request->all());
      if(isset($request->is_recieved))
      {
        $delivery = Delivery::find($request->delivery_id);
        $delivery->money += 10 ;
        $delivery->save(); 
        
      }
        return redirect()->route($this->getClassNameFromModel().'.index');
    }
    public function append()
    {
        $data['deliveries'] = Delivery::orderBy('id', 'DESC')->get();
        return  $data ; 
    }
}
