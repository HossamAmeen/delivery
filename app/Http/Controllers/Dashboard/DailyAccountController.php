<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DailyAccount;
use App\Models\Account;
class DailyAccountController extends BackEndController
{
    //////////// المصروفات في اليوم
    public function __construct(DailyAccount $model)
    {
        $this->model = $model;
    }
    
    public function store(Request $request)
    {
       
        $this->model->create($request->all());
        $accountToday = Account::where('date' , date('Y-m-d'))->first();
        if(isset( $accountToday))
        $accountToday->expenses =  $accountToday->expenses - $request->expenses;
        else
        {
            $accountToday = new Account();
            
            $accountToday->date = date('Y-m-d');
            $accountToday->expenses = - $request->expenses ;
            $accountToday->save();
        }
        
        $accountToday->save();
        return redirect()->route($this->getClassNameFromModel().'.index');
    }

    public function update(Request $request, $id)
    {
      $this->model::find($id)->update($request->all());

      return redirect()->route($this->getClassNameFromModel().'.index');
    }

}

