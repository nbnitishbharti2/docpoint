@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Appoinment Sloat</h4>
            </div>
            <div class="card-body">
                <form method ="POST" enctype='multipart/form-data' id="speciality-form" action="{{route('appointment.slots.store')}}">
                    @csrf
                       
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Sloat time*</label>
                        <div class="col-md-2"> 
                            <input name ="slot_time" required type="time" class="form-control" id="slot_time" value="{{ old('slot_time') }}">
                            @error('slot_time')
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
