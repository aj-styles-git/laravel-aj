@extends('layouts.master-without-nav')
@section('title')Dawrat Sign In @endsection
@section('content')

<div class="auth-bg-basic d-flex align-items-center min-vh-100">
    <div class="bg-overlay bg-light"></div>
    <div class="container">
        <div class="d-flex flex-column min-vh-100 py-5 px-3">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="text-center text-muted mb-2">
                        <div class="pb-3">
                            <a href="">
                                <span class="logo-lg">
                                    <img src="{{URL::asset('assets/images/dawrat_logo.png')}}" alt="" height="24"> <span class="logo-txt">Dawrat</span>
                                </span>
                            </a>
                            <p class="text-muted font-size-15 w-75 mx-auto mt-3 mb-0">Dawrat Admin Portal </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center my-auto">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-transparent shadow-none border-0">
                        <div class="card-body">
                            <div class="py-3">
                                <div class="text-center">
                                    <h5 class="mb-0">Welcome Back !</h5>
                                    <p class="text-muted mt-2">Sign in to continue to Dawrat.</p>
                                </div>
                                <form method="POST" action="{{ route('login') }}" class="mt-4 pt-2">
                                    @csrf

                                    <div class="form-floating form-floating-custom mb-3">
                                        <input type="email" id="email" placeholder="Enter User Name" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <label for="input-username">{{ __('Email Address') }}</label>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        {{-- <div class="form-floating-icon">
                                            <i class="uil uil-users-alt"></i>
                                        </div> --}}
                                    </div>


                                    <div class="form-floating form-floating-custom mb-3 auth-pass-inputgroup">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="enter your password">
                                        <!-- <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                            <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                        </button> -->
                                        <label for="password-input">{{ __('Password') }}</label>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        {{-- <div class="form-floating-icon">
                                            <i class="uil uil-padlock"></i>
                                        </div> --}}
                                    </div>

                                    <div class="form-check form-check-primary font-size-16 py-1">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                       
                                        <label class="form-check-label font-size-14" for="remember-check">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>

                                    <div class="mt-3">
                                        <button class="btn btn-primary w-100" type="submit">{{ __('Login') }}</button>
                                    </div>

                        

                                </form><!-- end form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end row -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="mt-4 mt-md-5 text-center">
                        <p class="mb-0">© <script>
                                document.write(new Date().getFullYear())

                            </script> Created  <i class="mdi mdi-heart text-danger"></i> by SmartDesizns</p>
                    </div>
                </div>
            </div> <!-- end row -->
        </div>
    </div>
    <!-- end container fluid -->
</div>
<!-- end authentication section -->
@endsection