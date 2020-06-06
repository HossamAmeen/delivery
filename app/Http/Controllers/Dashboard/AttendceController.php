<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attendce;
use App\Models\Sanction;
use App\Models\Delivery;

class AttendceController extends BackEndController
{
    public function __construct(Attendce $model)
    {
        $this->model = $model;
    }


    public function index()
    {
        $rows = $this->model;
        $rows = $this->filter($rows);
        $with = $this->with();
        if(!empty($with)){
            $rows = $rows->with($with);
        }
        if(request('date') != null)
        return "test";
        else
        // return "test2";
        $rows = $rows->orderBy('id', 'DESC')->get();
        $moduleName = $this->pluralModelName();
        $sModuleName = $this->getModelName();
        $routeName = $this->getClassNameFromModel();
        $pageTitle = "Control ".$moduleName;
        $pageDes = "Here you can add / edit / delete " .$moduleName;
        // return $rows;
        // return Auth::user()->role;

        return view('back-end.' . $routeName . '.index', compact(
            'rows',
            'pageTitle',
            'moduleName',
            'pageDes',
            'sModuleName',
            'routeName'
        ));
    }

    public function store(Request $request)
    {
        // return $request->all();
       $attendance =  $this->model->create($request->all());
       $delivery = Delivery::find($attendance->delivery_id);
        // return $attendance ;
       $attendanceTime = strtotime("+10 minutes", strtotime($delivery->attendance ));
    //    return date('h:i:s', $attendanceTime);
    //     return $attendanceTime;
    //    $selectedTime = "9:15";
    //    $endTime = strtotime("+15 minutes", strtotime($selectedTime));
    //    return date('h:i:s', $endTime);
        if(isset($request->delay_excuse))
        {
        $attendance->deduction = 0 ; 
        $attendance->save();
        
        }

       if (date("H:i", time()) > date("H:i", $attendanceTime)    ) {
         
            // return "late";
        if(!isset($request->delay_excuse))
        {
            $delivery->deduction += $request->deduction ; 
            $delivery->save();
            Sanction::create([
                'date' =>  date('Y-m-d') ,
                'deduction' =>  $request->deduction,
                'reason' => "تأخير",
                'delivery_id' =>$attendance->delivery_id ,
            ]);
        }
           
       }
       else
       {
        $attendance->deduction = 0 ; 
        $attendance->save();
       }
      
        return redirect()->route($this->getClassNameFromModel().'.index');
    }

    public function update(Request $request, $id)
    {
      $item = $this->model::find($id);
      $item->update($request->all());
    //   return $item;
    //   if(isset($request->is_recieved))
      {
        $delivery = Delivery::find($request->delivery_id);
        if(isset($request->daily_money) && is_numeric($request->daily_money))
        {
            $delivery->daily_money += $request->daily_money ;
            $delivery->save(); 
            
        }
        
      }
        return redirect()->route($this->getClassNameFromModel().'.index');
    }
    public function append()
    {
        $data['deliveries'] = Delivery::orderBy('id', 'DESC')->get();
        return  $data ; 
    }
}
