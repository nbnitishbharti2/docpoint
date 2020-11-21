@extends('layouts.backend')

@section('content')
@include('layouts.message')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
        <div class="user-grp-container">
            <h3 class="page-title">Manage Locations</h3>
            <a href="{{route('country.import')}}">Import Countries</a>
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
                                <th>Country Name</th>
                                <th>Iso Alpha 2</th>
                                <th>Iso Alpha 3</th>
                                <th>Currency Code</th>
                                <th>Dailing Code</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $country)
                            <tr>
                                <td>{{$country->name}}</td>
                                <td>{{$country->iso_alpha_2}}</td>
                                <td>{{$country->iso_alpha_3}}</td>
                                <td>{{$country->currency_code}}</td>
                                <td>+ {{$country->dailing_code}}</td> 
                                <td> 
                                <div class="status-toggle">
                                            <input type="checkbox" id="status_{{ $country->id }}" data-id = "{{ $country->id }}" class="country check" {{ ($country->active == '1')? 'checked': '' }}>
                                            <label for="status_{{ $country->id }}" class="checktoggle">checkbox</label>
                                        </div></td>
                                <td><a href="{{route('states',['id'=>$country->id])}}">Manage States/Province</a>

                                    <a class="btn-sm btn btn-info" title="Edit" href="{{route('country.edit',['id'=>$country->id])}}"><i class="fa fa-pencil"></i></a> 

                                             <button class="btn-sm btn btn-danger" title="Delete" onclick="confirm_country_delete({{ $country->id }})"><i class="fa fa-trash"></i></button>
                                       
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
<div class="modal fade" id="modal-country-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Country</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to Delete?</p>
        </div>
        <div class="modal-footer">
            <a href="{{ url('/country-delete/11') }}" id="delete-country" class="btn btn-danger">Delete</a>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    var change_country_status = "{{ route('change.country.status') }}";
</script>

@endsection