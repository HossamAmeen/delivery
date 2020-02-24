<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DailyAccount;

class DailyAccountController extends BackEndController
{
    public function __construct(DailyAccount $model)
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

}

