@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
        <div class="user-grp-container">
            <h3 class="page-title">Manage Cities</h3>
                <a href="{{route('city.import',['countryid'=>$country_id,'stateid'=>$state_id])}}">Import Cities</a>
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
                                <th>City Name</th>
                                <th>Alias</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $city)
                            <tr>
                                <td>{{$city->name}}</td>
                                <td>{{$city->alias}}</td> 
                                <td> <div class="status-toggle">
                                            <input type="checkbox" id="status_{{ $city->id }}" data-id = "{{ $city->id }}" class="city check" {{ ($city->active == '1')? 'checked': '' }}>
                                            <label for="status_{{ $city->id }}" class="checktoggle">checkbox</label>
                                        </div></td>
                                <td>
                                    <a href="{{route('locality.import',['countryid'=>$city->country_id,'stateid'=>$city->state_id,'cityid'=>$city->id])}}">Import Localities</a>
                                    ||<a href="{{route('locality.export',['countryid'=>$city->country_id,'stateid'=>$city->state_id,'cityid'=>$city->id])}}">Export Localities</a>

                                    ||<a href="{{route('locality.index',['countryid'=>$city->country_id,'stateid'=>$city->state_id,'cityid'=>$city->id])}}">Manage Localities</a>
                                     <a class="btn-sm btn btn-info" title="Edit" href="{{route('city.edit',['id'=>$city->id])}}"><i class="fa fa-pencil"></i></a>
                                     <button class="btn-sm btn btn-danger" title="Delete" onclick="confirm_city_delete({{ $city->id }})"><i class="fa fa-trash"></i></button>
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
<div class="modal fade" id="modal-city-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete city</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to Delete?</p>
        </div>
        <div class="modal-footer">
            <a href="{{ url('/city-delete/11') }}" id="delete-city" class="btn btn-danger">Delete</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    var change_city_status = "{{ route('change.city.status') }}";
</script>
@endsection