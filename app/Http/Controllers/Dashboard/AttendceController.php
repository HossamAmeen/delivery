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
      
        return redirect()->route($this->getClassNameFromModel().'.index');
    }

    public function update(Request $request, $id)
    {
      $item = $this->model::find($id);
      $item->update($request->all());
    //   return $item;
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
