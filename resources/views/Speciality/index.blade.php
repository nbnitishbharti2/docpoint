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
                                <th>Speciality Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $speciality)
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img rounded-circle" src="{{ ($speciality->pic && file_exists('public/storage/images/specialities/'.$speciality->pic)) ? asset('public/storage/images/specialities/'.$speciality->pic) : asset('public/storage/images/specialities/speciality-icon.png') }}" alt="{{ $speciality->spec_name }}">
                                        </a>
                                        <a href="#">{!! $speciality->spec_name !!}</a>
                                    </h2>
                                </td>
                                <td>
                                    <div class="status-toggle">
                                        <input type="checkbox" id="status_{!! $speciality->id !!}" data-id = "{!! $speciality->id !!}" class="speciality check" {{ ($speciality->status == 'Active')? 'checked': '' }}>
                                        <label for="status_{!! $speciality->id !!}" class="checktoggle">checkbox</label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('Speciality.edit', ['id' => $speciality->id]) }}" title="Edit Speciality" class="btn-sm btn btn-primary"><i class="fa fa-pencil"></i></a>
                                    <button class="btn-sm btn btn-danger" title="Delete" onclick="confirm_speciality_delete({{ $speciality->id }})"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="modal-speciality-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Speciality</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to Delete?</p>
        </div>
        <div class="modal-footer">
            <a href="{{ url('/speciality-delete/11') }}" id="delete-speciality" class="btn btn-danger">Delete</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.End delete confirmation modal -->
@endsection
@section('script')
<script>
    var change_speciality_status = "{{ route('change.speciality.status') }}";
</script>
@endsection
