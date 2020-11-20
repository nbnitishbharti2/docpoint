@extends('layouts.backend')
@section('content')
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
                                @php($active = $city->active == 1 ? "Yes" : "No")
                                <td>{{$active}}</td>
                                <td>
                                    <a href="{{route('locality.import',['countryid'=>$city->country_id,'stateid'=>$city->state_id,'cityid'=>$city->id])}}">Import Localities</a>
                                    ||<a href="{{route('locality.export',['countryid'=>$city->country_id,'stateid'=>$city->state_id,'cityid'=>$city->id])}}">Export Localities</a>
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

@endsection