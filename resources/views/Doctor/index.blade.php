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
                                <th>Speciality</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Sponsored</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doctors as $doctor)
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="{{ route('doctor.profile', ['id' => $doctor->id]) }}" class="avatar avatar-sm mr-2">
                                                <img class="avatar-img rounded-circle" src="{{ ($doctor->pic && file_exists('public/storage/images/doctor/'.$doctor->pic)) ? asset('public/storage/images/doctor/'.$doctor->pic) : asset('public/files/doctor/profile/doctor-icon.png') }}" alt="Doctor Image">
                                            </a>
                                            <a href="{{ route('doctor.profile', ['id' => $doctor->id]) }}">{{ $doctor->name }}</a>
                                        </h2>
                                    </td>
                                    <td>{{ $doctor->speciality->spec_name }}</td>
                                    <td>{{ $doctor->mobile }}</td>
                                    <td>{{ $doctor->email }}</td>
                                    <td>
                                        <div class="status-toggle">
                                            <input type="checkbox" id="status_{{ $doctor->id }}" data-id = "{{ $doctor->id }}" class="doctor check" {{ ($doctor->status == 'Active')? 'checked': '' }}>
                                            <label for="status_{{ $doctor->id }}" class="checktoggle">checkbox</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="status-toggle">
                                            <input type="checkbox" id="sponsored_{{ $doctor->id }}" data-id = "{{ $doctor->id }}" class="sponsored check" {{ ($doctor->sponsored == 'Yes')? 'checked': '' }}>
                                            <label for="sponsored_{{ $doctor->id }}" class="checktoggle">checkbox</label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('doctor.edit', ['id' => $doctor->id]) }}" title="Edit" class="btn-sm btn btn-primary"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('log.history', ['user_id' => $doctor->user_id]) }}" title="Log History" class="btn-sm btn btn-primary"><i class="fa fa-history"></i></a>
                                        <button class="btn-sm btn btn-danger" title="Delete" onclick="confirm_doctor_delete({{ $doctor->id }})"><i class="fa fa-trash"></i></button>
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
    var change_doctor_status = "{{ route('change.doctor.status') }}";
    var change_doctor_sponsored_status = "{{ route('change.doctor.sponsored.status') }}";
</script>
@endsection