@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit City</h4>
            </div>
            <div class="card-body">
                <form method ="POST" enctype='multipart/form-data' id="speciality-form" action="{{route('city.edit', ['city_id'=>$data->id])}}">
                    @csrf
                      <div class="form-group row">
                        <label class="col-form-label col-md-2">Country Name</label>
                        <div class="col-md-10">
                            <input type="text" readonly="" class="form-control"   value="{{ $data->country->name }}"> 
                        </div> 
                     </div>
                     <div class="form-group row">
                        <label class="col-form-label col-md-2">State Name</label>
                        <div class="col-md-10">
                            <input type="text" readonly="" class="form-control"   value="{{ $data->state->name }}"> 
                        </div> 
                     </div> 
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Name*</label>
                        <div class="col-md-10">
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <input name ="name" required type="text" class="form-control" id="name" value="{{ old('name', $data->name) }}">
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
