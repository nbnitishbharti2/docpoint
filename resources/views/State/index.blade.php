@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
        <div class="user-grp-container">
            <h3 class="page-title">Manage States</h3>
                <a href="{{route('state.import',['id'=>$id])}}">Import States</a>
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
                                <th>State Name</th>
                                <th>Alias</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($states as $state)
                            <tr>
                                <td>{{$state->name}}</td>
                                <td>{{$state->alias}}</td> 
                                <td>
                                    <input type="checkbox" id="status_{{ $state->id }}" data-id = "{{ $state->id }}" class="state check" {{ ($state->active == '1')? 'checked': '' }}>
                                    <label for="status_{{ $state->id }}" class="checktoggle">checkbox</label>
                                </td>
                                <td>
                                    <a href="{{route('cities',['countryid'=>$state->country_id,'stateid'=>$state->id])}}">Manage Cities</a>
                                    <a class="btn-sm btn btn-info" title="Edit" href="{{route('state.edit',['id'=>$state->id])}}"><i class="fa fa-pencil"></i></a>
                                    <button class="btn-sm btn btn-danger" title="Delete" onclick="confirm_state_delete({{ $state->id }})"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="modal-state-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete state</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to Delete?</p>
        </div>
        <div class="modal-footer">
            <a href="{{ url('/state-delete/11') }}" id="delete-state" class="btn btn-danger">Delete</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    var change_state_status = "{{ route('change.state.status') }}";
</script>

@endsection