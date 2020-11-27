@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="user-grp-container">
                <h3 class="page-title">Login History</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>IP Address</th>
                                <th>Agent</th>
                                <th>Login Time</th>
                                <th>Logout Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr>
                                    
                                    <td>{{ $log->ip_address }}</td>
                                    <td>{{ $log->user_agent }}</td>
                                    <td>{{ ($log->login_at != null) ? \Carbon\Carbon::parse($log->login_at)->format("d-m-Y H:i A") : '' }}</td>
                                    <td>{{ ($log->logout_at != null) ? \Carbon\Carbon::parse($log->logout_at)->format("d-m-Y H:i A") : '' }}</td>
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