@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>Doctor Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor)
                                <tr>
                                    <td>{{ $doctor->name }}</td>
                                    <td>{{ $doctor->mobile }}</td>
                                    <td>{{ $doctor->email }}</td>
                                    <td>{{ $doctor->address }}</td>
                                    <td>{{ $doctor->status }}</td>
                                    <td>{{ date("d-m-Y", strtotime($doctor->created_at)) }}</td>
                                    <td>
                                        @if ($doctor->status == "Pending")
                                            <a href="{{ route('change.registered.doctor.status', [$doctor->id]) }}" class="btn btn-success">Approve</a>
                                            <a href="{{ route('reject.registered.doctor', [$doctor->id]) }}" class="btn btn-danger">Reject</a>
                                        @elseif($doctor->status == "Rejected")
                                            <a href="{{ route('change.registered.doctor.status', [$doctor->id]) }}" class="btn btn-success">Approve</a>
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

<!-- /.delete confirmation modal -->
<div class="modal fade" id="modal-doctor-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Doctor</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to Delete?</p>
        </div>
        <div class="modal-footer">
            <a href="{{ url('/doctor-delete/11') }}" id="delete-doctor" class="btn btn-danger">Delete</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
@section('script')
<script>
    //var change_registered_doctor_status = "{{ route('change.registered.doctor.status') }}";
</script>
@endsection