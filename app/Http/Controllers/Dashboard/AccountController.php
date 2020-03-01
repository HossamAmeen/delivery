<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;

class AccountController extends BackEndController
{
    public function __construct(Account $model)
    {
        $this->model = $model;
    }
    
    public function store(Request $request)
    {
       $accountToday = Account::where('date' , date('Y-m-d'))->first();
       if(isset($accountToday))
       {
        $accountToday->expenses = $request->expenses ; 
        $accountToday->save();
       }
       else
        $this->model->create($request->all());

        return redirect()->route($this->getClassNameFromModel().'.index');
    }

    public function update(Request $request, $id)
    {
            
      $this->model::find($id)->update($request->all());

      return redirect()->route($this->getClassNameFromModel().'.index');
    }

}
