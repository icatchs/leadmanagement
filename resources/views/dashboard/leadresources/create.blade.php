@extends('layouts.admin')

@section('content') 
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
                    <span></span>Lead Resources <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
          </div>    
       <!-- header page info end  -->




       <div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header bg-gradient-info">
                <div class="float-start">
                   <h3 class="text-white">Manage Lead Resources</h3> 
                </div>
                <div class="float-end">
                    <a href="{{ route('leadresources.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('leadresources.store') }}" method="post">
                    @csrf
                   <input type="hidden" name="ids" value="{{ $leadsource->id ?? ''}}">
                    <div class="mb-3">
                        <label for="description" class="d-block col-form-label text-start">Name</label>
                 
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $leadsource->name ?? '' }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                  
                        <label for="description" class="d-block col-form-label text-start">Description</label>
                                
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" cols="50">{{ $leadsource->description ?? '' }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif  
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Submit">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>


@endsection