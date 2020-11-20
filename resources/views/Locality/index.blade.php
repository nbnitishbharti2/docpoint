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

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $locality)
                            <tr>
                                <td>{{$locality->name}}</td>
                                <td>{{$locality->pincode}}</td>
                                @php($active = $locality->active == 1 ? "Yes" : "No")
                                <td>{{$active}}</td>
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