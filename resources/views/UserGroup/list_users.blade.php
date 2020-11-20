@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="user-grp-container">
                <h3 class="page-title">All Users</h3>
            </div>
            <ul class="breadcrumb"></ul>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $newUser)
                                <tr>
                                    <td>{{$newUser->name}}</td>
                                    <td>{{$newUser->email}}</td>
                                    <td>{{$newUser->mobile}}</td>
                                    <td>
                                        <div class="status-toggle">
                                            <input type="checkbox" id="status_{{ $newUser->id }}" data-id = "{{ $newUser->id }}" class="user check" {{ ($newUser->status == 'Active')? 'checked': '' }}>
                                            <label for="status_{{ $newUser->id }}" class="checktoggle">checkbox</label>
                                        </div>
                                    </td>
                                    <td>
                                        @if(CommanHelper::checkUserRole($newUser->id) != "Admin")
                                            <button class="btn-sm btn btn-danger" title="Delete" onclick="confirm_user_delete({{ $newUser->id }})"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="modal-user-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to Delete?</p>
        </div>
        <div class="modal-footer">
            <a href="{{ url('/user-delete/11') }}" id="delete-user" class="btn btn-danger">Delete</a>
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
    var change_user_status = "{{ route('change.user.status') }}";
</script>
@endsection