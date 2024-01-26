@extends('layouts.front')

@section('content')
<div class="container-fluid page-body-wrapper">
    <div class="content-wrapper d-flex align-items-center auth bg-gradient-info">
        <div class="row flex-grow">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header bg-gradient-success">
                        <h3 class="text-dark text-center">Register</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
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
                                    <label for="name" class="d-block col-form-label text-md-start">{{ __('Confirm Password') }}</label>
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

                            </div> 

                            <div class="row mb-0">
                                <div class="col-md-12 mx-auto">
                                    <button type="submit" class="btn btn-primary float-end">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
