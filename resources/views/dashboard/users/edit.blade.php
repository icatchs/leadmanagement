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
                    <span></span>Edit Profile <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
          
       <!-- header page info end  -->
          


       <div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-gradient-info">
                <div class="float-start">
                   <h3 class="text-white">Edit User Profile</h3>
                </div>
                <div class="float-end">
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="d-block col-form-label text-start">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $company->company_name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="d-block col-form-label text-start">E-mail</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $company->company_email }}">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="col-md-6">
                                    <label for="contact_person" class="d-block col-form-label text-md-start">{{ __('Contact Person') }}</label>
                                    <input id="contact_person" type="text" class="form-control @error('contact_person') is-invalid @enderror" name="contact_person" value="{{ $company->contact_person ?? '' }}" required autocomplete="contact_person" autofocus>
                                        @error('contact_person')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="d-block col-form-label text-md-start">{{ __('Phone Number') }}</label>
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $company->company_phone ?? '' }}" required autocomplete="name" autofocus>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="city" class="d-block col-form-label text-md-start">{{ __('City') }}</label>
                                    <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $company->company_city ?? '' }}" required autocomplete="city" autofocus>
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="state" class="d-block col-form-label text-md-start">{{ __('State') }}</label>
                                    <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ $company->company_state ?? '' }}" required autocomplete="state" autofocus>
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="state" class="d-block col-form-label text-md-start">{{ __('Profile Image') }}</label>
                                    <input type="file" id="profile_img" name="profile_img" accept="image/*" class="form-control @error('profile_img') is-invalid @enderror" >
                                    
                                        @error('profile_img')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                         
                                @if (Auth::user()->hasRole('Super Admin'))
                                <div class="col-md-6">
                                    <label for="roles" class="d-block col-form-label text-start">Roles</label>
                                    <select class="form-select @error('roles') is-invalid @enderror" multiple aria-label="Roles" id="roles" name="roles[]">
                                        @forelse ($roles as $role)

                                            @if ($role!='Super Admin')
                                            <option value="{{ $role }}" {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>
                                                {{ $role }}
                                            </option>
                                            @else
                                                @if (Auth::user()->hasRole('Super Admin'))   
                                                <option value="{{ $role }}" {{ in_array($role, $userRoles ?? []) ? 'selected' : '' }}>
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
                                @endif
                           
                                


                        </div>

                    

                  <!--   <div class="mb-3 row">
                        <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                        <div class="col-md-6">
                          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
                        <div class="col-md-6">
                          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div> -->

                    
                    
                    <div class="my-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update User">
                    </div>
                    
                </form>

                <div class="row">
                    <img src="{{ asset('assets/images/company/profiles/' . $user->img )  ?? URL::asset('assets/images/placeholder.jpg') }}" alt="" class="img-fluid" style="height:150px;width:200px;border-radius:50%;">
                </div>
            </div>
        </div>
    </div>
</div>    












@endsection