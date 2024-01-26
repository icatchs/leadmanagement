@extends('layouts.admin')

@section('content') 
      <!-- must include header page info  -->
         
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
   
       <!-- header page info end  -->


       <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-gradient-info">
                        <div class="float-start">
                            <h3 class="text-white">Add New User/Company</h3>
                        </div>
                <div class="float-end">
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="post">
                    @csrf

                    <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="name" class="d-block col-form-label text-md-start">{{ __('Company Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                

                                <div class="col-md-6">
                                    <label for="name" class="d-block col-form-label text-md-start">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="name" class="d-block col-form-label text-md-start">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="password" class="d-block col-form-label text-md-start">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="col-md-6">
                                    <label for="contact_person" class="d-block col-form-label text-md-start">{{ __('Contact Person') }}</label>
                                    <input id="contact_person" type="text" class="form-control @error('contact_person') is-invalid @enderror" name="contact_person" value="{{ old('contact_person') }}" required autocomplete="contact_person" autofocus>
                                        @error('contact_person')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="d-block col-form-label text-md-start">{{ __('Phone Number') }}</label>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="name" autofocus>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="city" class="d-block col-form-label text-md-start">{{ __('City') }}</label>
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="state" class="d-block col-form-label text-md-start">{{ __('State') }}</label>
                                    <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state') }}" required autocomplete="state" autofocus>
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="col-md-6">  
                                    <label for="roles" class="d-block col-form-label text-md-start">{{ __('Roles') }}</label>         
                                    <select class="form-control @error('roles') is-invalid @enderror" multiple aria-label="Roles" id="roles" name="roles[]">
                                        @forelse ($roles as $role)

                                            @if ($role!='Super Admin')
                                                <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                                {{ $role }}
                                                </option>
                                            @else
                                                @if (Auth::user()->hasRole('Super Admin'))   
                                                    <option value="{{ $role }}" {{ in_array($role, old('roles') ?? []) ? 'selected' : '' }}>
                                                    {{ $role }}
                                                    </option>
                                                @endif
                                            @endif

                                        @empty

                                        @endforelse
                                    </select>
                            @if ($errors->has('roles'))
                                <span class="text-danger">{{ $errors->first('roles') }}</span>
                            @endif
                        </div>

                    </div>
                    
                    <div class="my-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add User">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>    



@endsection