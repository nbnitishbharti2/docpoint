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
                                        @if($value->status != 'Canceled')
                                            <div class="status-toggle">
                                                <input type="checkbox" title="Change Status" id="status_{{ $value->id }}" data-id = "{{ $value->id }}" class="appointment check" {{ ($value->status == 'Active')? 'checked': '' }}>
                                                <label for="status_{{ $value->id }}" class="checktoggle">checkbox</label>
                                            </div>
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
<script>
    var change_appoinment_status = "{{ route('change.appointment.status') }}";
</script>
@endsection