@extends('layouts.admin')

@section('content') 
        @php 
            if(!empty($leads)){
                
                $type = "Edit";
                $name = $leads->name;
                $lead_source = $leads->lead_source;
                $email = $leads->email;
                $phone = $leads->phone;
                $from = $leads->from;
                $to = $leads->to;
                $enquiry_date =  date("m/d/Y", strtotime($leads->enquiry_date));
                $travel_date =  date("m/d/Y", strtotime($leads->travel_date));
                $adult_count = $leads->adult_count;
                $remark = $leads->remark;
            }else{
                $type = "Add";
                $name = '';
                $lead_source = '';
                $email = '';
                $phone = '';
                $from = '';
                $to = '';
                $enquiry_date ='';
                $travel_date = '';
                $adult_count = '';
                $remark = '';
            }
        @endphp
      <!-- must include header page info  -->
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white me-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Leads/{{ $type }} <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
          </div>    
       <!-- header page info end  -->
            @if(session()->has('success'))
              <div class="alert alert-success">
                  {{ session()->get('success') }}
              </div>
            @endif
      


       <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header bg-gradient-info">
                        <div class="float-start">
                            <h3 class="text-white">{{ $type }} Lead</h3>
                        </div>
                        <div class="float-end">
                            <a href="{{ route('leads.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('leads.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="lead_id" value="{{ $leads->id ?? '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="d-block col-form-label text-start">Customer Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $name ?? '' }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
               
                                <div class="col-md-6">
                                    <label for="email" class="d-block col-form-label text-start">Customer Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $email ?? '' }}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="d-block col-form-label text-start">Customer Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $phone ?? '' }}">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="adult_count" class="d-block col-form-label text-start">No. Of Adults</label>
                                    <input type="number" class="form-control @error('adult_count') is-invalid @enderror" id="adult_count" name="adult_count" value="{{ $adult_count ?? '' }}">
                                    @if ($errors->has('adult_count'))
                                        <span class="text-danger">{{ $errors->first('adult_count') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="from" class="d-block col-form-label text-start">From</label>
                                    <input type="text" class="form-control @error('from') is-invalid @enderror" id="from" name="from" value="{{ $from ?? '' }}">
                                    @if ($errors->has('from'))
                                        <span class="text-danger">{{ $errors->first('from') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="to" class="col-md-6 col-form-label text-start">To</label>
                                    <input type="text" class="form-control @error('to') is-invalid @enderror" id="to" name="to" value="{{ $to ?? '' }}">
                                    @if ($errors->has('to'))
                                        <span class="text-danger">{{ $errors->first('to') }}</span>
                                    @endif
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="enquiry_date" class="col-md-6 col-form-label text-start">Enquiry Date</label>
                                    <input type="text" class="form-control @error('enquiry_date') is-invalid @enderror" id="enquiry_date" name="enquiry_date" value="{{ $enquiry_date ?? '' }}">
                                    @if ($errors->has('enquiry_date'))
                                        <span class="text-danger">{{ $errors->first('enquiry_date') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="travel_date" class="col-md-6 col-form-label text-start">Travel Date</label>
                                    <input type="text" class="form-control @error('travel_date') is-invalid @enderror" id="travel_date" name="travel_date" value="{{ $travel_date ?? '' }}">
                                    @if ($errors->has('travel_date'))
                                        <span class="text-danger">{{ $errors->first('travel_date') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="lead_status" class="col-md-6 col-form-label text-start">Lead Status</label>
                                    <select name="lead_status" id="lead_status" class="form-select @error('lead_status') is-invalid @enderror">
                                            <option value="">Select Lead Status</option>
                                            @forelse($leadstatus as $lstatus)
                                                @if($lstatus->id == $leads->lead_status)
                                                    <option value="{{ $lstatus->id }}" selected>{{ $lstatus->name }}</option>
                                                @else
                                                    <option value="{{ $lstatus->id }}">{{ $lstatus->name }}</option>
                                                @endif
                                            @empty
                                                <option value="">No Resource Found</option>
                                            @endforelse
                                    </select>
                                    @if ($errors->has('lead_status'))
                                        <span class="text-danger">{{ $errors->first('lead_status') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="lead_source" class="col-md-6 col-form-label text-start">Lead Source</label>
                                    <select name="lead_source" id="lead_source" class="form-select @error('lead_source') is-invalid @enderror">
                                            <option value="">Select Lead Source</option>
                                            @forelse($leadresource as $lsource)
                                                @if($lsource->id == $lead_source)
                                                    <option value="{{ $lsource->id }}" selected>{{ $lsource->name }}</option>
                                                @else
                                                    <option value="{{ $lsource->id }}">{{ $lsource->name }}</option>
                                                @endif
                                            @empty
                                                <option value="">No Resource Found</option>
                                            @endforelse
                                    </select>
                                    @if ($errors->has('lead_source'))
                                    <span class="text-danger">{{ $errors->first('lead_source') }}</span>
                                    @endif
                                </div>



                                <div class="col-md-6">
                                    <label for="remark" class="d-block col-form-label text-start">Description</label>
                                
                                        <textarea class="form-control @error('remark') is-invalid @enderror" id="remark" name="remark" rows="4" cols="50">{{ $remark ?? '' }}</textarea>
                                        @if ($errors->has('remark'))
                                            <span class="text-danger">{{ $errors->first('remark') }}</span>
                                        @endif                                   
                                </div> 

                            </div>
                           

                            
                            
                            <div class="my-3 ">
                                <input type="submit" class="float-end offset-md-5 btn btn-gradient-primary" value="Submit">
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>    
        </div>


@endsection

