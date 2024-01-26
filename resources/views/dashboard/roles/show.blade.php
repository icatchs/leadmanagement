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
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
          </div>    
       <!-- header page info end  -->


       <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Role Information
                </div>
                <div class="float-end">
                    <a href="{{ route('roles.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="mb-3 row">
                        <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $role->name }}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>Permissions:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            @if ($role->name=='Super Admin')
                                <span class="badge bg-primary">All</span>
                            @else
                                @forelse ($rolePermissions as $permission)
                                    <span class="badge bg-primary">{{ $permission->name }}</span>
                                @empty
                                @endforelse
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>    

@endsection