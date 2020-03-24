<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PriceList;

class PriceListController extends BackEndController
{
    public function __construct(PriceList $model)
    {
        $this->model = $model;
    }

    public function store(Request $request){
        //    return $request->all();
           
            $requestArray = $request->all();
            // return $requestArray ; 
            if(isset($requestArray['image']) )
            {
                $fileName = $this->uploadImage2($request );
                // $requestArray['image'] = "شسي";// $fileName;
                $requestArray['image'] =  $fileName;
            }
        //    return $requestArray ; 
          
            $this->model->create($requestArray);
            session()->flash('action', 'تم الاضافه بنجاح');
           
          
     
            return redirect()->route($this->getClassNameFromModel().'.index');
        }

    public function update(Request $request, $id)
    {
        $complaint = $this->model::find($id);
        $requestArray = $request->all();
            // return $requestArray ; 
            if(isset($requestArray['image']) )
            {
                $fileName = $this->uploadImage2($request );
                // $requestArray['image'] = "شسي";// $fileName;
                $requestArray['image'] =  $fileName;
            }
        $complaint->update($requestArray);
        session()->flash('action', 'تم التحديث بنجاح');
        return redirect()->route($this->getClassNameFromModel().'.index');
    }
}
