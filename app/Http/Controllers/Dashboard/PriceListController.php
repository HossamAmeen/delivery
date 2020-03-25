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
        $priceList = $this->model::find($id);
        $requestArray = $request->all();
            // return $requestArray ; 
            // $oldImage = null ; 
            if(isset($requestArray['image']) )
            {
                if (file_exists($priceList->image)) 
                {
                    // $oldImage = $priceList->image ; 
                    unlink($priceList->image);
                }
                   
                    
                $fileName = $this->uploadImage2($request );
                // $requestArray['image'] = "شسي";// $fileName;
                $requestArray['image'] =  $fileName;
            
            }
        $priceList->update($requestArray);
        session()->flash('action', 'تم التحديث بنجاح');
        return redirect()->route($this->getClassNameFromModel().'.index');
    }
    public function destroy($id)
    {
       $item =  $this->model->FindOrFail($id);
       if (file_exists($item->image)) 
            {
                // $oldImage = $priceList->image ; 
                unlink($item->image);
            }
            $item->delete();
        session()->flash('action', 'تم الحذف بنجاح');
        return redirect()->back();
       
    }
}
