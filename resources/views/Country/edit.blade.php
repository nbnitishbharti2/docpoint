@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Country</h4>
            </div>
            <div class="card-body">
                <form method ="POST" enctype='multipart/form-data' id="speciality-form" action="{{route('country.edit', ['country_id'=>$data->id])}}">
                    @csrf
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
                     <div class="form-group row">
                        <label class="col-form-label col-md-2">IOS Alpha 2*</label>
                        <div class="col-md-4">
                            <input name ="iso_alpha_2" required type="text" class="form-control" id="iso_alpha_2" value="{{ old('iso_alpha_2', $data->iso_alpha_2) }}">
                            @error('iso_alpha_2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                      
                        <label class="col-form-label col-md-2">IOS Alpha 3*</label>
                        <div class="col-md-4">
                            <input name ="iso_alpha_3" required type="text" class="form-control" id="iso_alpha_3" value="{{ old('iso_alpha_3', $data->iso_alpha_3) }}">
                            @error('iso_alpha_3')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-form-label col-md-2">Currency Code*</label>
                        <div class="col-md-4">
                            <input name ="currency_code" required type="text" class="form-control" id="currency_code" value="{{ old('currency_code', $data->currency_code) }}">
                            @error('currency_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                      
                        <label class="col-form-label col-md-2">Dailing Code*</label>
                        <div class="col-md-4">
                            <input name ="dailing_code" required type="text" class="form-control" id="dailing_code" value="{{ old('dailing_code', $data->dailing_code) }}">
                            @error('dailing_code')
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
