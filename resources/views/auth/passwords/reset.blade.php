@extends('layouts.master-without-nav')

@section('title')
Reset Password
@endsection

@section('css')

@endsection

@section('body')

<body class="auth-body-bg">
    @endsection

    @section('content')
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="bg-primary bg-soft">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-primary p-4">
                                            <h5 class="text-dark">Reset Password</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0"> 
                            
                            @if(getSettingInfo('login_logo')!="")                            
                                <div class="auth-logo">
                                    <a href="index.html" class="auth-logo-light">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ URL::asset('uploads/settings/'.getSettingInfo('login_logo')) }}" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>

                                    <a href="index.html" class="auth-logo-dark">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ URL::asset('uploads/settings/'.getSettingInfo('login_logo')) }}" alt="" class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a>
                                </div>
                                @endif
                                <div class="p-2">
                                    @include('widget/notifications')
                                    <form class="form-horizontal" method="POST" action="{{ route('password.update') }}">
                                            @csrf
                                            <input type="hidden" name="token" value="{{ $token }}">
                                            <div class="mb-3">
                                                <label for="useremail" class="form-label">Email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail" name="email" placeholder="Enter email" value="{{ $email ?? old('email') }}" id="email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="userpassword">Password</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="userpassword" placeholder="Enter password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="userpassword">Confirm Password</label>
                                                <input id="password-confirm" type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password">
                                            </div>

                                            <div class="mt-3 d-grid">
                                                <button class="btn btn-dark w-md waves-effect waves-light" type="submit">Reset</button>
                                            </div>

                                           
                                            <div class="mt-4 text-center">                                            
                                                Remember It ? <a href="{{ url('login') }}" class="text-muted">Sign In</a>
                                            </div>

                                        </form>
                                </div>            
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            
                            <div>
                                <!-- <p>Don't have an account ? <a href="register.html" class="fw-medium text-primary"> Signup now </a> </p> -->
                                <p>© <script>document.write(new Date().getFullYear())</script> {{Config::get('constants.AppnameGlobe') }}.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    

    @endsection
    @section('script')

    @endsection