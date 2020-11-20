@extends('layouts.backend')
@section('content')
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
    @endif
    @endforeach
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add User Group</h4>
            </div>
            <div class="card-body">
                <form method ="POST"  action="{{route('user_groups_add')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Name*</label>
                        <div class="col-md-10">
                            <input name ="name" required type="text" class="form-control" id="name" value="{{ old('name') }}">
                            @error('spec_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Redirect URL</label>
                        <div class="col-md-10">
                            <input name ="redirect_url" type="text" class="form-control" id="name" value="{{ old('redirect_url') }}">
                            @error('spec_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="col-form-label col-md-2">Status</label>
                    <div class="col-md-10">
                        <div class="checkbox">
                            <label>
                                <input name="active"  type="checkbox">
                            </label>
                        </div>
                    </div>
                    </div>
                </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection