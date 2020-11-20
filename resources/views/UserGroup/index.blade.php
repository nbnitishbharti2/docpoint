@extends('layouts.backend')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
        <div class="user-grp-container">
            <h3 class="page-title">User Groups</h3>
            <a href="{{route('user_groups_add')}}">Add User Group</a>
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
                                <th>Group Name</th>
                                <th>Alias</th>
                                <th>Redirect URL</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $newGroup)
                            <tr>
                                <td>{{$newGroup->name}}</td>
                                <td>{{$newGroup->alias_name}}</td>
                                <td>{{empty($newGroup->redirect_url) ? 'Form Config' : $newGroup->redirect_url}}</td>
                                @php($active = $newGroup->active == 1 ? "checked" : null)
                                <td>
                                    <div class="status-toggle">
                                        <input type="checkbox" id="status_{{$newGroup->id}}" class="check" {{$active}}>
                                        <label for="status_1" class="checktoggle">checkbox</label>
                                    </div>
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