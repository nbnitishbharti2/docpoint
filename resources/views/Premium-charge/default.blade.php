@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="user-grp-container">
                <h3 class="page-title">&nbsp;</h3>
               
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Default Charge Settings </h4>
            </div>
            <div class="card-body">
                <form method = "POST" id="premium_charges" action = "{{ route('update.default.charge') }}">
                    @csrf
                    
                     
                    <div class="row">
                        <div class="col-md-6">
                            <label class="col-form-label col-md-6"><center>physical Visit</center></label>
                            <div class="form-group row">
                               
                                <div class="col-md-6">
                                     <label>Nornal Patient</label>
                                    <input name ="physical_normal_charge"  type="number" class="form-control" placeholder="Enter Charge" id="physical_normal_charge" value="{{ (old('physical_normal_charge') ? old('physical_normal_charge') : $premium_charge->physical_normal_charge??'') }}">
                                    @error('physical_normal_charge')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group row">
                               
                                <div class="col-md-6">
                                     <label>Service Charge cash (%)</label>
                                    <input name ="physical_normal_commission_cash"  type="number" class="form-control" id="physical_normal_commission_cash" placeholder="Enter %" value="{{ (old('physical_normal_commission_cash') ? old('physical_normal_commission_cash') : $premium_charge->physical_normal_commission_cash??'') }}">
                                    @error('physical_normal_commission_cash')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <input name ="physical_normal_commission_cash_status"  type="checkbox" class="form-control" id="physical_normal_commission_cash_status" {{ (isset($premium_charge->physical_normal_commission_cash_status) && $premium_charge->physical_normal_commission_cash_status==1) ? 'checked' :'' }}>
                                    @error('physical_normal_commission_cash_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                 <div class="col-md-6">
                                     <label>Service Charge online (%)</label>
                                    <input name ="physical_normal_commission_online"  type="number" class="form-control" id="physical_normal_commission_online" placeholder="Enter %" value="{{ (old('physical_normal_commission_online') ? old('physical_normal_commission_online') : $premium_charge->physical_normal_commission_online??'') }}">
                                    @error('physical_normal_commission_online')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                     <input name ="physical_normal_commission_online_status"  type="checkbox" class="form-control" id="physical_normal_commission_online_status" placeholder="Enter %" {{ (isset($premium_charge->physical_normal_commission_online_status) && $premium_charge->physical_normal_commission_online_status==1) ? 'checked' :'' }}>
                                    @error('physical_normal_commission_online_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                                </div>
                                 <div class="col-md-6">
                                     <label>Premium Patient</label>
                                    <input name ="physical_premium_charge"  type="number" class="form-control" id="physical_premium_charge" placeholder="Enter Charge" value="{{ (old('physical_premium_charge') ? old('physical_premium_charge') : $premium_charge->physical_premium_charge??'') }}">
                                    @error('physical_premium_charge')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group row">
                               
                                <div class="col-md-6">
                                     <label>Service Charge cash (%)</label>
                                    <input name ="physical_premium_commission_cash"  type="number" class="form-control" id="physical_premium_commission_cash" placeholder="Enter %" value="{{ (old('physical_premium_commission_cash') ? old('physical_premium_commission_cash') : $premium_charge->physical_premium_commission_cash??'') }}">
                                    @error('physical_premium_commission_cash')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <input name ="physical_premium_commission_cash_status"  type="checkbox" class="form-control" id="physical_premium_commission_cash_status" {{ (isset($premium_charge->physical_premium_commission_cash_status) && $premium_charge->physical_premium_commission_cash_status==1) ? 'checked' :'' }}>
                                    @error('physical_premium_commission_cash_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                 <div class="col-md-6">
                                     <label>Service Charge online (%)</label>
                                    <input name ="physical_premium_commission_online"  type="number" class="form-control" id="physical_premium_commission_online" placeholder="Enter %" value="{{ (old('physical_premium_commission_online') ? old('physical_premium_commission_online') : $premium_charge->physical_premium_commission_online??'') }}">
                                    @error('physical_premium_commission_online')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <input name ="physical_premium_commission_online_status"  type="checkbox" class="form-control" id="physical_premium_commission_online_status" {{ (isset($premium_charge->physical_premium_commission_online_status) && $premium_charge->physical_premium_commission_online_status==1) ? 'checked' :'' }}>
                                    @error('physical_premium_commission_online_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-form-label col-md-6"><center>Video Visit</center></label>
                             <div class="form-group row">
                               
                                <div class="col-md-6">
                                     <label>Normal Patient</label>
                                    <input name ="video_normal_charge"  type="number" class="form-control" id="video_normal_charge" placeholder="Enter Charge" value="{{ (old('video_normal_charge') ? old('video_normal_charge') : $premium_charge->video_normal_charge??'') }}">
                                    @error('video_normal_charge')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group row">
                               
                                <div class="col-md-6">
                                     <label>Service Charge cash (%)</label>
                                    <input name ="video_normal_commission_cash"  type="number" class="form-control" id="video_normal_commission_cash" placeholder="Enter %" value="{{ (old('video_normal_commission_cash') ? old('video_normal_commission_cash') : $premium_charge->video_normal_commission_cash??'') }}">
                                    @error('video_normal_commission_cash')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <input name ="video_normal_commission_cash_status"  type="checkbox" class="form-control" id="video_normal_commission_cash_status" {{ (isset($premium_charge->video_normal_commission_cash_status) && $premium_charge->video_normal_commission_cash_status==1) ? 'checked' :'' }}>
                                    @error('video_normal_commission_cash_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                 <div class="col-md-6">
                                     <label>Service Charge online (%)</label>
                                    <input name ="video_normal_commission_online"  type="number" class="form-control" id="video_normal_commission_online" placeholder="Enter %" value="{{ (old('video_normal_commission_online') ? old('video_normal_commission_online') : $premium_charge->video_normal_commission_online??'') }}">
                                    @error('video_normal_commission_online')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <input name ="video_normal_commission_online_status"  type="checkbox" class="form-control" id="video_normal_commission_online_status" {{ (isset($premium_charge->video_normal_commission_online_status) && $premium_charge->video_normal_commission_online_status==1) ? 'checked' :'' }}>
                                    @error('video_normal_commission_online_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                                </div>
                                 <div class="col-md-6">
                                     <label>Premium Patient</label>
                                    <input name ="video_premium_charge"  type="number" placeholder="Enter Charge" class="form-control" id="video_premium_charge" value="{{ (old('video_premium_charge') ? old('video_premium_charge') : $premium_charge->video_premium_charge??'') }}">
                                    @error('video_premium_charge')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="form-group row">
                               
                                <div class="col-md-6">
                                     <label>Service Charge cash (%)</label>
                                    <input name ="video_premium_commission_cash"  type="number" class="form-control" id="video_premium_commission_cash" placeholder="Enter %" value="{{ (old('video_premium_commission_cash') ? old('video_premium_commission_cash') : $premium_charge->video_premium_commission_cash??'') }}">
                                    @error('video_premium_commission_cash')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <input name ="video_premium_commission_cash_status"  type="checkbox" class="form-control" id="video_premium_commission_cash_status" {{ (isset($premium_charge->video_premium_commission_cash_status) && $premium_charge->video_premium_commission_cash_status==1) ? 'checked' :'' }} >
                                    @error('video_premium_commission_cash_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                 <div class="col-md-6">
                                     <label>Service Charge online (%)</label>
                                    <input name ="video_premium_commission_online"  type="number" class="form-control" id="video_premium_commission_online" placeholder="Enter %" value="{{ (old('video_premium_commission_online') ? old('video_premium_commission_online') : $premium_charge->video_premium_commission_online??'') }}">
                                    @error('video_premium_commission_online')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <br>
                                    <input name ="video_premium_commission_online_status"  type="checkbox" class="form-control" id="video_premium_commission_online_status" {{ (isset($premium_charge->video_premium_commission_online_status) && $premium_charge->video_premium_commission_online_status==1) ? 'checked' :'' }} >
                                    @error('video_premium_commission_online_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                                </div>
                            </div>
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