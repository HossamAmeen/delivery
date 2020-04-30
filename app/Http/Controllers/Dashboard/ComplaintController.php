<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends BackEndController
{
    public function __construct(Complaint $model)
    {
        $this->model = $model;
    }

    public function store(Request $request)
    {
        $this->model->create($request->all());
        session()->flash('action', 'تم الاضافه بنجاح');
        return redirect()->route($this->getClassNameFromModel() . '.index');
    }

    public function update(Request $request, $id)
    {
        $complaint = $this->model::find($id);
        $complaint->update($request->all());
        session()->flash('action', 'تم التحديث بنجاح');
        return redirect()->route($this->getClassNameFromModel() . '.index');
    }

    public function UnReadComplaintCount()
    {

        return response()->json([
            'complaintCount' => Complaint::where('is_read', 0)->count(),
        ]);
    }

    public function updateStatusComplaint()
    {
        Complaint::where('is_read', 0)->update([
            'is_read' => 1,
        ]);
        return response()->json(['status' => "success"]);
    }
}
