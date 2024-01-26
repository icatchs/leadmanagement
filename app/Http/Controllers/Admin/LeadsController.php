<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\lead;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use App\Models\Pendinglead;

class LeadsController extends Controller
{
    public function index($type=null){
        $leads = Lead::with('leadSource','leadStatus')->latest('id')->paginate(10);
        //dd($leads);
        return view('dashboard.leads.index',compact('leads'));
    }

    public function create($lead =null){
        $leads = Lead::with('leadSource','leadStatus')->where('id', $lead)->first();
        $leadresource = LeadSource::get();
        $leadstatus = LeadStatus::get();
        return view('dashboard.leads.create',compact('leads', 'leadresource', 'leadstatus'));
    }
  
    public function store(Request $request){

       /*  $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]); */

        if($request->lead_id){
            $leads = Lead::where('id', $request->lead_id)->first();
            $type = 'Updated';
        }else{
            $leads = new Lead;
            $type = 'Added';
        }

        if($request->enquiry_date){
            $enquiryDate = Carbon::createFromFormat('m/d/Y', $request->enquiry_date)->format('Y-m-d');
        }else{
            $enquiryDate = null;
        }
        if($request->travel_date){
            $travel_date = Carbon::createFromFormat('m/d/Y', $request->travel_date)->format('Y-m-d');
        }else{
            $travel_date = null;
        }
       
        $leads->user_id         = Auth::user()->id;
        $leads->name            = $request->name;
        $leads->lead_source     = $request->lead_source;
        $leads->email           = $request->email;
        $leads->phone           = $request->phone;
        $leads->from            = $request->from;
        $leads->to              = $request->to;
        $leads->enquiry_date    = $enquiryDate;
        $leads->travel_date     = $travel_date;
        $leads->adult_count     = $request->adult_count;
        $leads->remark          = $request->remark;
        $leads->lead_status     = $request->lead_status;
        $leads->save();       
        return redirect()->route('leads.index')->with('success', 'Lead '. $type . ' successfully.');
    }
    public function delete(){

    }

    public function processImport(Request $request){
     
        $validatedData = $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:10240',
        ]);

        $file = $request->file('csv_file');
        if ($file->getClientOriginalExtension() !== 'csv') {
            return redirect()->back()->withErrors(['csv_file' => 'The uploaded file must be a CSV file.'])->withInput();
        }

        $data = array_map('str_getcsv', file($file->getPathname()));
        $isFirstRow = true;
        foreach ($data as $row) {
            if ($isFirstRow) {
                $isFirstRow = false;
                continue;
            }
        
            if($row[6]){
                $enquiryDate = Carbon::createFromFormat('d-m-Y', $row[6])->format('Y-m-d');
            }else{
                $enquiryDate = null;
            }
            if($row[7]){
                $travel_date = Carbon::createFromFormat('d-m-Y', $row[7])->format('Y-m-d');
            }else{
                $travel_date = null;
            }
            Lead::create([
                'user_id'           => Auth::user()->id,      
                'name'              => $row[0],
                'lead_source'       => $row[1],
                'email'             => $row[2],
                'phone'             => $row[3],
                'from'              => $row[4],
                'to'                => $row[5],
                'enquiry_date'      => $enquiryDate,
                'travel_date'       => $travel_date,
                'adult_count'       => $row[8],
                'remark'            => $row[9],
            ]);
        }
        return redirect()->route('leads.index')->with('success', 'Leads imported successfully.');
    }


    public function movetopending($ids = null){
        if(!empty($ids)){
            $lead = Lead::where('id',$ids)->first();
            if(!empty($lead)){
               /*  $pendingLead = new Pendinglead;
                $pendingLead->user_id         = Auth::user()->id;

                $pendingLead->lead_id         = $lead->id;
                $pendingLead->name            = $lead->name;
                $pendingLead->lead_source     = $lead->lead_source;
                $pendingLead->email           = $lead->email;
                $pendingLead->phone           = $lead->phone;
                $pendingLead->from            = $lead->from;
                $pendingLead->to              = $lead->to;
                $pendingLead->enquiry_date    = $lead->enquiry_date;
                $pendingLead->travel_date     = $lead->travel_date;
                $pendingLead->adult_count     = $request->adult_count;
                $pendingLead->remark          = $request->remark;
                $pendingLead->save();    */    

                $lead->lead_status = 'Pending';
                $lead->save();
                return redirect()->route('leads.index')->with('success', 'Leads imported successfully.');
            }
     
        }
        return redirect()->route('leads.index')->with('success', 'Please Select A Valid Lead.');

    }
}
