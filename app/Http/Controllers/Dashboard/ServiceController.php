<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceController extends BackEndController
{
    public function __construct(Service $model)
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
        if(!isset($request->is_avaible))
        $item->is_avaible = 0 ;
        $item->save();
        return redirect()->route($this->getClassNameFromModel().'.index');
    }


}
