<?php

namespace App\Http\Controllers\APIs;
use App\Http\Controllers\APIResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MobileController extends Controller
{
    use APIResponseTrait;
    public function services()
    {
        return $this->APIResponse(\App\Models\Service::where('is_avaible' , 1)->get(), null, 201);
    }
    public function priceList()
    {
        return $this->APIResponse(\App\Models\PriceList::all(), null, 201);
    }
    public function complaint(Request $request)
    {
        \App\Models\Complaint::create($request->all());
        return $this->APIResponse(null, null, 200);
    }
    public function cities()
    {
        return $this->APIResponse(City::all(), null, 201);
    }
}
