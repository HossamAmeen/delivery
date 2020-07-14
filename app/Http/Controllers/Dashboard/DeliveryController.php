<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Delivery;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryController extends BackEndController
{
    public function __construct(Delivery $model)
    {
        parent::__construct($model);
    }
    public function store(Request $request){
        //    return $request->all();

            $rules = $this->FormValidation();
            $message = $this->MessageValidation();
            $this->validate($request, $rules, $message);

            $requestArray = $request->all();
            if(isset($requestArray['password']) )
            $requestArray['password'] =  Hash::make($requestArray['password']);
            if(isset($requestArray['image']) )
            {
                $fileName = $this->uploadImage($request );
                $requestArray['image'] =  $fileName;
            }

            $requestArray['user_id'] = Auth::user()->id;
            $this->model->create($requestArray);
            session()->flash('action', 'تم الاضافه بنجاح');



            return redirect()->route($this->getClassNameFromModel().'.index');
        }

        public function update($id , Request $request){


            $rules = $this->FormValidation();
            $message = $this->MessageValidation();
            $this->validate($request, $rules, $message);
            $row = $this->model->FindOrFail($id);
            $requestArray = $request->all();
            if(isset($requestArray['password']) && $requestArray['password'] != ""){
                $requestArray['password'] =  Hash::make($requestArray['password']);
            }else{
                unset($requestArray['password']);
            }
            if(isset($requestArray['image']) )
            {
                $fileName = $this->uploadImage($request );
                $requestArray['image'] =  $fileName;
            }

            $requestArray['user_id'] = Auth::user()->id;
            $row->update($requestArray);



            session()->flash('action', 'تم التحديث بنجاح');
            return redirect()->route($this->getClassNameFromModel().'.index');
        }
        public function FormValidation()
        {
                return array(
                    'delivery_ratio' => 'numeric',
                    'deduction' => 'numeric',
                    'daily_money' => 'numeric',
                    'money' => 'numeric',
                );
        }
        public function MessageValidation()
        {
           
            return array(
                
                'delivery_ratio.numeric' => 'يجب ان يكون رقما فقط',    
                'deduction.numeric' => 'يجب ان يكون رقما فقط',    
                'daily_money.numeric' => 'يجب ان يكون رقما فقط',    
                'money.numeric' => 'يجب ان يكون رقما فقط',    
            );
        }
}
