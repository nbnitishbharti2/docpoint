@extends('layouts.frontend')
@section('title', 'MyDocPoint | Login')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="{{ asset('public/assets/img/login-banner.png') }}" class="img-fluid" alt="Doccure Login">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>Login <span>Doccure</span></h3>
                                </div>
                                @if(Session::has('error'))
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        {{ Session::pull('error') }}
                                    </div>
                                @endif
                                <form method="POST" id="login" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group form-focus login-form">
                                        <label class="focus-label">Email</label>
                                        <input type="email" class="form-control floating" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @if($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group form-focus login-form">
                                        <label class="focus-label">Password</label>
                                        <input type="password" class="form-control floating" name="password" required autocomplete="current-password">
                                        @if($errors->has('password'))
                                            <div class="error">{{ $errors->first('password') }}</div>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        <a class="forgot-link" href="{{ Url('password/reset') }}">Forgot Password ?</a>
                                    </div>
                                    <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Login</button>
                                    <div class="text-center dont-have">Don’t have an account? 
                                        <a href="{{ Route('doctor.registration') }}">Register</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
