@extends('layouts.frontend')
@section('title', 'MyDocPoint | Register Doctor')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-bottom: 30px;">
                <div class="card-header">{{ __('Doctor Register') }}</div>
                <div class="card-body">
                    <form method="POST" id="doctor-registration" action="{{ route('create.doctor') }}">
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
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <textarea id="address" minlength="10" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="address">{{ old('address') }}</textarea> 
                                @if($errors->has('address'))
                                    <div class="error">{{ $errors->first('address') }}</div>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary register">
                                    {{ __('Register') }}
                                </button>
                                 &nbsp;&nbsp;<a href="{{ Route('doctor.login') }}">Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
