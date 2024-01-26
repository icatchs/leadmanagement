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
                    <span></span>Permissions <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                   <h3 class="text-white">Add New permission</h3> 
                </div>
                <div class="float-end">
                    <a href="{{ route('permissions.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('permissions.store') }}" method="post">
                    @csrf
                    <P class="text-center text-danger">Please keep in mind that permission name should define the route and should be separated with `-` for example create-project. No blank spaces are allowed</P>
                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
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