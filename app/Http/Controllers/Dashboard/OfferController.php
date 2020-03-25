<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Offer;
use Auth;
use Illuminate\Http\Request;

class OfferController extends BackEndController
{
    public function __construct(Offer $model)
    {
        parent::__construct($model);
    }
    public function store(Request $request)
    {
        //    return $request->all();

        $requestArray = $request->all();
        // return $requestArray ;
        if (isset($requestArray['image'])) {
            $fileName = $this->uploadImage2($request);
            // $requestArray['image'] = "شسي";// $fileName;
            $requestArray['image'] = $fileName;
        }
        //    return $requestArray ;
        $requestArray['user_id'] = Auth::user()->id;
        $this->model->create($requestArray);
        session()->flash('action', 'تم الاضافه بنجاح');

        return redirect()->route($this->getClassNameFromModel() . '.index');
    }
    public function destroy($id)
    {
        $item = $this->model->FindOrFail($id);
        if (file_exists($item->image)) {
            // $oldImage = $priceList->image ;
            unlink($item->image);
        }
        $item->delete();
        session()->flash('action', 'تم الحذف بنجاح');
        return redirect()->back();

    }

}
