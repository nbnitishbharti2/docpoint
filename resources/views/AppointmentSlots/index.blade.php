@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="user-grp-container">
                <h3 class="page-title">Manage Appointment Slots</h3>
                <a href="{{route('appointment.slots.add')}}">Add Appointment Slots</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-center mb-0 display nowrap">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Appoinment Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointment_slots as $key => $value)
                            @php 
                                if($key == 0) {
                                    echo "hhhh";
                                    $counter = 0;
                                    $date = date("Y-m-d", strtotime($value->slot_date_time));
                                }
                                if($date != date("Y-m-d", strtotime($value->slot_date_time))) {
                                    echo "2222";
                                    $counter = 0;
                                    $date = date("Y-m-d", strtotime($value->slot_date_time));
                                }
                            @endphp
                            <tr>
                                @if ($date == date("Y-m-d", strtotime($value->slot_date_time)) && $counter == 0)
                                    @php
                                        ++$counter;   
                                    @endphp
                                    <td><i class="btn btn-xs fa fa-list-ul" data-toggle = "collapse" data-target = ".collapsed{{ $key }}">+</i>&nbsp;{{ date("Y-m-d", strtotime($value->slot_date_time))}}</td>
                                @else 
                                    <td class="collapse collapsed{{ $key }}">{{ date("Y-m-d", strtotime($value->slot_date_time))}}</td>
                                @endif
                                
                                <td>{{ date("h:i a", strtotime($value->slot_date_time))}}</td>
                                <td>{{ $value->status }}</td>
                                <td>{{ $value->appointment_type }}</td>
                                <td>
                                    <button class="btn-sm btn btn-danger" title="Delete" onclick="confirm_appoinment_sloats_delete({{ $value->id }})"><i class="fa fa-trash"></i></button>
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
<!-- /.delete confirmation modal -->
<div class="modal fade" id="modal-appointment-sloat-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Appointment Sloat</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to Delete?</p>
        </div>
        <div class="modal-footer">
            <a href="{{ url('/appointment-slots-delete/11') }}" id="delete-appointment-sloat" class="btn btn-danger">Delete</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    var change_appoinmrnt_slot_status = "{{ route('change.appointment.slots.status') }}";
    $(document).ready( function () {
        var table = $('.table').DataTable({
            // "columnDefs": [
            //     { targets: 0, visible: false }
            // ],
        
            rowReorder: {
                selector: 'td:last-child'
            },
        });
    });
</script>

@endsection