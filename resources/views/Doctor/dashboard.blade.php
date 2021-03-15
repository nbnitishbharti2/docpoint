@extends('layouts.backend')
@section('content')
@include('layouts.message')
 <form method="get" style="margin-bottom: 20px;">
    <div class="row"> 
            <div class="col-xl-4 col-sm-6 col-12">
                <input type="text" id="from" value="{{ $from }}" name="from"  class="form-control">
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <input type="text" id="to" name="to" value="{{ $to }}" class="form-control">
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <button type="summit" class="btn btn-info">search</button>
            </div>
        
    </div>
    </form>
    <div class="row">
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-success">
                            <i class="fe fe-credit-card"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $patient_count }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Total Patients</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success w-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-danger border-danger">
                            <i class="fe fe-money"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $appointments->count() }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Total Appointment</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger w-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-warning border-warning">
                            <i class="fe fe-folder"></i>
                        </span>
                        <div class="dash-count">
                            <h3>₹{{ $patient_count_revenue }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Total Revenue</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-warning w-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-success">
                            <i class="fe fe-credit-card"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $patient_count_accepted }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Total Accepted</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success w-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-info">
                            <i class="fe fe-credit-card"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $patient_count_recected }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Total Pending</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-info w-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="dash-widget-header">
                        <span class="dash-widget-icon text-danger">
                            <i class="fe fe-credit-card"></i>
                        </span>
                        <div class="dash-count">
                            <h3>{{ $patient_count }}</h3>
                        </div>
                    </div>
                    <div class="dash-widget-info">

                        <h6 class="text-muted">Total Rejected</h6>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-danger w-50"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- box end -->
    <div class="row">
        <div class="col-md-12">
            <!-- Recent Orders -->
            <div class="card card-table">
                <div class="card-header">
                    <h4 class="card-title">@if($today==1)
                    Today's Appointment
                @else  
                {{ date('d-M-Y', strtotime($from)).' To '.date('d-M-Y',strtotime($to)).' Appointment' }}
            @endif</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="today_appointments">
                        <table class="table table-hover table-center mb-0">
                            <thead>
                                <tr>
                                    <th>Patient Name</th>
                                    <th>Mobile No</th>
                                    <th>Purpose</th>
                                    <th>Patient Type</th>
                                    <th>Apointment Type</th>
                                    <th>Date & Time</th>
                                    <th>Amount</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $value)
                                    <tr>
                                        <td>{{ Str::ucfirst($value->user->name) }}</td>
                                        <td>{{ ($value->user->mobile) }}</td>
                                        <td>{{ Str::ucfirst($value->reason->name) }}</td>
                                        <td>{{ Str::ucfirst($value->patient_type) }}</td>
                                        <td>{{ Str::ucfirst($value->appointment_type) }}</td>
                                        <td>{{ date("d-m-Y h:i A", strtotime($value->appointment_slot->slot_date_time)) }}</td>
                                        <td> 
                                            {{ Str::ucfirst($value->status) }}
                                        </td>
                                        <td>
                                            @if ($value->status == "Active")
                                                <a href="#" data-href="{{ route('approve.appointment', [$value->id]) }}" class="btn btn-success" title="Approve" data-toggle="modal" data-target="#confirm"><i class="fa fa-check"></i></a>
                                                <a href="#" data-href="{{ route('reject.appointment', [$value->id]) }}" class="btn btn-danger" title="Reject" data-toggle="modal" data-target="#confirm"><i class="fa fa-times"></i></a>        
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /Recent Orders -->
        </div>
    </div>

    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="header-text"></h4>
                </div>
                <div class="modal-body">
                    <p class="body-text"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <a class="btn btn-danger btn-ok"></a>
                </div>
            </div>
        </div>
    </div>
    <script  src="{{ asset('public/admin/assets/js/custom.js')}}"></script>
    <script>
        $(document).ready(function(){
            window.mA = Morris.Area({
	    element: 'morrisArea',
	    data: [
	        { y: '2013', a: 60},
	        { y: '2014', a: 100},
	        { y: '2015', a: 240},
	        { y: '2016', a: 120},
	        { y: '2017', a: 80},
	        { y: '2018', a: 100},
	        { y: '2019', a: 300},
	    ],
	    xkey: 'y',
	    ykeys: ['a'],
	    labels: ['Revenue'],
	    lineColors: ['#1b5a90'],
	    lineWidth: 2,
		
     	fillOpacity: 0.5,
	    gridTextSize: 10,
	    hideHover: 'auto',
	    resize: true,
		redraw: true
	});
        });
    </script>
    <script>
$(function(){
    $("#from").datepicker({
        todayBtn:  1,
        autoclose: true,
        format: 'dd-mm-yyyy',
        orientation: 'auto bottom',
       // startDate: new Date(),
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#to').datepicker('setStartDate', minDate);
    });

    $("#to").datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy',
        orientation: 'auto bottom',
    }).on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('#from').datepicker('setEndDate', maxDate);
    });
});
</script>
@endsection