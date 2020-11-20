@extends('layouts.backend')

@section('content')
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
                                @php($active = $country->active == 1 ? "Yes" : "No")
                                <td>{{$active}}</td>
                                <td><a href="{{route('states',['id'=>$country->id])}}">Manage States/Province</a></td>
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