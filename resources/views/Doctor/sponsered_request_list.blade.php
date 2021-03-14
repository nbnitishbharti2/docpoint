@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0">
                        <thead>
                            <tr>
                                <th>Doctor Name</th>
                                <th>Speciality</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Sponsored</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sponsored_requests as $sponsored_request)
                                <tr>
                                    <td>
                                        <h2 class="table-avatar">
                                            <a href="{{ route('doctor.profile', ['id' => $sponsored_request->id]) }}" class="avatar avatar-sm mr-2">
                                                <img class="avatar-img rounded-circle" src="{{ ($sponsored_request->pic && file_exists('public/storage/images/doctor/'.$sponsored_request->pic)) ? asset('public/storage/images/doctor/'.$sponsored_request->pic) : asset('public/files/doctor/profile/doctor-icon.png') }}" alt="Doctor Image">
                                            </a>
                                            <a href="{{ route('doctor.profile', ['id' => $sponsored_request->id]) }}">{{ $sponsored_request->name }}</a>
                                        </h2>
                                    </td>
                                    <td>{{ $sponsored_request->speciality->spec_name }}</td>
                                    <td>{{ $sponsored_request->mobile }}</td>
                                    <td>{{ $sponsored_request->email }}</td>
                                    <td>
                                        <div class="status-toggle">
                                            <input type="checkbox" id="sponsored_{{ $sponsored_request->id }}" data-id = "{{ $sponsored_request->id }}" class="sponsored check" {{ ($sponsored_request->sponsored == 'Yes')? 'checked': '' }}>
                                            <label for="sponsored_{{ $sponsored_request->id }}" class="checktoggle">checkbox</label>
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
@section('script')
<script>
    var change_doctor_sponsored_status = "{{ route('change.doctor.sponsored.status') }}";
</script>
@endsection