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
            <ul class="breadcrumb">
            </ul>
        </div>
    </div>
</div>
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
    @endif
    @endforeach
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{ date("h:i a", strtotime($value->slot_time))}}</td>
                               <td> <div class="status-toggle">
                                            <input type="checkbox" id="status_{{ $value->id }}" data-id = "{{ $value->id }}" class="appointment-sloat check" {{ ($value->status == '1')? 'checked': '' }}>
                                            <label for="status_{{ $value->id }}" class="checktoggle">checkbox</label>
                                        </div></td>
                                <td>
                                    <a class="btn-sm btn btn-info" title="Edit" href="{{route('appointment.slots.edit',['id'=>$value->id])}}"><i class="fa fa-pencil"></i></a>
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
</script>
@endsection