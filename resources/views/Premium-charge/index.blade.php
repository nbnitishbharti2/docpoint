@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="user-grp-container">
                <h3 class="page-title">&nbsp;</h3>
                @if($premium_charge)
                    <a href="{{ route('premium.charge.delete', $doctor_id) }}">Remove Premium Charge</a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Premium Charge Settings </h4>
            </div>
            <div class="card-body">
                <form method = "POST" id="premium_charges" action = "{{ route('update.premium.charge', $doctor_id) }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Amount*</label>
                        <div class="col-md-10">
                            <input name ="amount" required type="text" class="form-control" id="amount" value="{{ (old('amount') ? old('amount') : $premium_charge->amount??'') }}">
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">No of Patient*</label>
                        <div class="col-md-10">
                            <input name ="no_of_patient" required type="number" class="form-control" id="no_of_patient" value="{{ (old('no_of_patient') ? old('no_of_patient') : $premium_charge->no_of_patient??'') }}">
                            @error('no_of_patient')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Premium Patient*</label>
                        <div class="col-md-10">
                            <input name ="premium_patient" required type="number" class="form-control" id="premium_patient" value="{{ (old('premium_patient') ? old('premium_patient') : $premium_charge->premium_patient??'') }}">
                            @error('premium_patient')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('doctor.index') }}" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
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