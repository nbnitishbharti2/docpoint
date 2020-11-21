@extends('layouts.backend')
@section('content')

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
                                <th>Locality Name</th>
                                <th>Pincode</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $locality)
                            <tr>
                                <td>{{$locality->name}}</td>
                                <td>{{$locality->pincode}}</td>
                                 <td> <div class="status-toggle">
                                            <input type="checkbox" id="status_{{ $locality->id }}" data-id = "{{ $locality->id }}" class="location check" {{ ($locality->active == '1')? 'checked': '' }}>
                                            <label for="status_{{ $locality->id }}" class="checktoggle">checkbox</label>
                                        </div></td>
                                        <td>
                                             <a class="btn-sm btn btn-info" title="Edit" href="{{route('locality.edit',['id'=>$locality->id])}}"><i class="fa fa-pencil"></i></a>
                                             <button class="btn-sm btn btn-danger" title="Delete" onclick="confirm_location_delete({{ $locality->id }})"><i class="fa fa-trash"></i></button></td>
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
<div class="modal fade" id="modal-location-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Locality</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to Delete?</p>
        </div>
        <div class="modal-footer">
            <a href="{{ url('/location-delete/11') }}" id="delete-location" class="btn btn-danger">Delete</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    var change_location_status = "{{ route('change.location.status') }}";
</script>

@endsection