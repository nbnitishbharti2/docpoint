@extends('layouts.frontend')
@section('title', 'MyDocPoint | Register User')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-bottom: 30px;">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" id="user-registration" action="{{ route('create.user') }}">
                        @csrf
                        <div class="form-group row registraion-form-input">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @if($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row registraion-form-input">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @if($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                         <div class="form-group row registraion-form-input">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Mobile No.') }}</label>
                            <div class="col-md-6">
                                <input id="mobile" type="text" onkeypress="return onlyNumberKey(event)" maxlength="10" minlength="10" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">
                                @if($errors->has('mobile'))
                                    <div class="error">{{ $errors->first('mobile') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row registraion-form-input">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @if($errors->has('password'))
                                    <div class="error">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row registraion-form-input">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary register">
                                    {{ __('Register') }}
                                </button>
                                 &nbsp;&nbsp;<a href="{{ Route('user.login') }}">Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
