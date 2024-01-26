<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeadSource;
use Illuminate\Support\Facades\Auth;

class LeadsourceController extends Controller
{
    /* leadresources */
    public function index(){
        $leadresources = LeadSource::all();
        return view('dashboard.leadresources.index',compact('leadresources'));
    }

    public function manage($ids=null){
        if($ids){
            $leadsource = LeadSource::where('id',$ids)->first();
        }else{
            $leadsource = '';
        }
        return view('dashboard.leadresources.create',compact('leadsource'));
    }

    public function store(Request $request){
        
        if($request->ids){
            $type = 'updated';
            $leadsource = LeadSource::where('id',$request->ids)->first();
        }else{
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:lead_sources,name',
            ]);
            $type = 'created';
            $leadsource = new LeadSource;
        }
       
        $leadsource->user_id        = Auth::user()->id;
        $leadsource->name           = $request->name;
        $leadsource->description    = $request->description;
        $leadsource->save();
        return redirect()->route('leadresources.index')->with('success', 'Lead source '. $type . ' successfully.');
    }
    
    public function delete(){

    }
}
