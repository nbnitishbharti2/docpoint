@extends('layouts.backend')
@section('content')
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
                            @foreach($data as $state)
                            <tr>
                                <td>{{$state->name}}</td>
                                <td>{{$state->alias}}</td>
                                @php($active = $state->active == 1 ? "Yes" : "No")
                                <td>{{$active}}</td>
                                <td><a href="{{route('cities',['countryid'=>$state->country_id,'stateid'=>$state->id])}}">Manage Cities</a></td>
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