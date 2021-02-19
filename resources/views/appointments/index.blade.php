@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="user-grp-container">
                <h3 class="page-title">Manage Appointments</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Name</th>
                                <th>Reason</th>
                                <th>Patient Type</th>
                                <th>Appointment Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $value)
                                <tr>
                                    <td>{{ date("d-m-Y", strtotime($value->appointment_date)) }}</td>
                                    <td>{{ date("h:i A", strtotime($value->appointment_slot->slot_time)) }}</td>
                                    <td>{{ Str::ucfirst($value->user->name) }}</td>
                                    <td>{{ Str::ucfirst($value->reason->name) }}</td>
                                    <td>{{ Str::ucfirst($value->patient_type) }}</td>
                                    <td>{{ Str::ucfirst($value->appointment_type) }}</td>
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
@endsection