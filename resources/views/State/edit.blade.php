@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit State</h4>
            </div>
            <div class="card-body">
                <form method ="POST" enctype='multipart/form-data' id="speciality-form" action="{{route('state.edit', ['state_id'=>$state->id])}}">
                    @csrf
                      <div class="form-group row">
                        <label class="col-form-label col-md-2">Country Name</label>
                        <div class="col-md-10">
                            <input type="text" readonly="" class="form-control"   value="{{ $state->country->name }}"> 
                        </div> 
                     </div> 
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Name*</label>
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $state->id }}">
                            <input name ="name" required type="text" class="form-control" id="name" value="{{ old('name', $state->name) }}">
                            @error('name')
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
