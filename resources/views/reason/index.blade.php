@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="user-grp-container">
                <h3 class="page-title">Manage Reason</h3>
                <a href="{{route('reason.add')}}">Add Reason</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>Speciality</th>
                                <th>Reason Name</th>
                                @if (!Auth::user()->doctors) 
                                <th>Status</th>
                                @endif
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reasons as $reason)
                                <tr>
                                    <td>{{ $reason->speciality->spec_name }}</td>
                                    <td>{{ $reason->name }}</td>
                                    @if (!Auth::user()->doctors) 
                                    <td>
                                        <div class="status-toggle">
                                            <input type="checkbox" id="status_{{ $reason->id }}" data-id = "{{ $reason->id }}" class="reason check" {{ ($reason->status == 'Active')? 'checked': '' }}>
                                            <label for="status_{{ $reason->id }}" class="checktoggle">checkbox</label>
                                        </div>
                                    </td>
                                    @endif

                                    <!-- <td>
                                        <a href="{{-- route('reason.edit', ['id' => $reason->id]) --}}" title="Edit" class="btn-sm btn btn-primary"><i class="fa fa-pencil"></i></a>
                                        <button class="btn-sm btn btn-danger" title="Delete" onclick="confirm_reason_delete({{-- $reason->id --}})"><i class="fa fa-trash"></i></button>
                                    </td> -->
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
@section('script')
<script>
    var change_reason_status = "{{ route('change.reason.status') }}";
</script>
@endsection

