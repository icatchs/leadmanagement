<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeadStatus;
use Illuminate\Support\Facades\Auth;
class LeadStatusController extends Controller
{
    public function index(){
        $leadstatus = LeadStatus::with('user')->latest('id')->paginate(10);
        return view('dashboard.leadstatus.index', compact('leadstatus'));
    }

    public function manage($ids = null){
        if($ids){
            $leadstatus = LeadStatus::where('id',$ids)->first();
        }else{
            $leadstatus = '';
        }
        return view('dashboard.leadstatus.manage',compact('leadstatus'));
    }

    public function store(Request $request){
        

        if($request->ids){
            $validatedData = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'regex:/^[A-Z]+$/',
                ],
            ]);
            $leadstatus = LeadStatus::where('id',$request->ids)->first();
            $type = 'updated';
        }else{
            $validatedData = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:lead_statuses,name',
                    'regex:/^[A-Z]+$/',
                ],
            ]);
            $leadstatus = new LeadStatus;
            $type = 'created';
        }

        $leadstatus->user_id    = Auth::user()->id;
        $leadstatus->name       = $request->name;
        $leadstatus->remark     = $request->remark;
        $leadstatus->save();

        return redirect()->route('leadstatus.index')->with('success', 'Lead status '. $type . ' successfully.');
    }
}
