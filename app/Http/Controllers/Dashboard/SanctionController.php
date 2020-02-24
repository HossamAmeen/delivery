<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Sanction;
use App\Http\Controllers\Controller;

class SanctionController extends BackEndController
{
    public function __construct(Sanction $model)
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
      $this->model::find($id)->update($request->all());

        return redirect()->route($this->getClassNameFromModel().'.index');
    }

    public function append()
    {
        $data['deliveries'] = Delivery::orderBy('id', 'DESC')->get();
      
        return  $data ; 
    }

}
