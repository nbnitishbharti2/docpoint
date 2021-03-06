@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Appoinment Slot</h4>
            </div>
            <div class="card-body">
                <form method ="POST" enctype='multipart/form-data' id="appointment-slot-form" action="{{route('appointment.slots.store')}}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Start Date*</label>
                        <div class="col-md-4"> 
                            <input name ="start_date" required type="text" class="form-control" id="start_date" value="">
                            @error('start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <label class="col-form-label col-md-2">End Date*</label>
                        <div class="col-md-4"> 
                            <input name ="end_date" required type="text" min="{{ date('Y-m-d') }}" class="form-control" id="end_date" value="{{ old('end_date') }}">
                            @error('end_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Start time*</label>
                        <div class="col-md-4"> 
                            <input name ="start_time" required type="time" class="form-control" id="start_time" value="{{ old('start_time') }}">
                            @error('start_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <label class="col-form-label col-md-2">End Time*</label>
                        <div class="col-md-4"> 
                            <input name ="end_time" required type="time" class="form-control" id="end_time" value="{{ old('end_time') }}">
                            @error('end_time')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Interval (In Minutes)*</label>
                        <div class="col-md-4"> 
                            <input name ="interval" type="number" class="form-control" id="interval" value="{{ old('interval') }}">
                            @error('interval')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <label class="col-form-label col-md-2">On Day</label>
                        <div class="col-md-4"> 
                            <div class="weekDays-selector">
                                <input type="checkbox" id="weekday-mon" name="days[0]" value="Monday" class="weekday" />
                                <label for="weekday-mon">M</label>
                                <input type="checkbox" id="weekday-tue" name="days[1]" value="Tuesday" class="weekday" />
                                <label for="weekday-tue">T</label>
                                <input type="checkbox" id="weekday-wed" name="days[2]" value="Wednesday" class="weekday" />
                                <label for="weekday-wed">W</label>
                                <input type="checkbox" id="weekday-thu" name="days[3]" value="Thrusday" class="weekday" />
                                <label for="weekday-thu">T</label>
                                <input type="checkbox" id="weekday-fri" name="days[4]" value="Friday" class="weekday" />
                                <label for="weekday-fri">F</label>
                                <input type="checkbox" id="weekday-sat" name="days[5]" value="Saturday" class="weekday" />
                                <label for="weekday-sat">S</label>
                                <input type="checkbox" id="weekday-sun" name="days[6]" value="Sunday" class="weekday" />
                                <label for="weekday-sun">S</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Appointment Type*</label>
                        <div class="col-md-4 pt-8">
                            <input type="radio" name="appointment_type" id="appointment_type_physical" value="Physical" {{ (old('appointment_type') == "Physical" || old('appointment_type') == null) ? "checked" : '' }}> 
                            <label for="appointment_type_physical">Physical</label>
                            <input type="radio" name="appointment_type" id="appointment_type_video" value="Video">
                            <label for="appointment_type_video">Video</label>
                            @error('appointment_type')
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
<script>
$(function(){
    $("#start_date").datepicker({
        todayBtn:  1,
        autoclose: true,
        format: 'dd/mm/yyyy',
        orientation: 'auto bottom',
        startDate: new Date(),
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#end_date').datepicker('setStartDate', minDate);
    });

    $("#end_date").datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        orientation: 'auto bottom',
    }).on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('#start_date').datepicker('setEndDate', maxDate);
    });
});
</script>
@endsection
