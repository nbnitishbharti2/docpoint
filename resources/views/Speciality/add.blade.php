@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Speciality</h4>
            </div>
            <div class="card-body">
                <form method = "POST" enctype = 'multipart/form-data' id="speciality-form" action = "{{route('Speciality.add')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Speciality*</label>
                        <div class="col-md-10">
                            <input name ="spec_name" required type="text" class="form-control" id="name" value="{{ old('spec_name') }}">
                            @error('spec_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Choose Pic*</label>
                        <div class="col-md-10">
                            <input name ='pic' class="form-control" type="file">
                            @error('pic')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script  src="{{ asset('public/admin/assets/js/custom.js')}}"></script>
@endsection