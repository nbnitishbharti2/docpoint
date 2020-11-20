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
                                <th>Speciality Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $speciality)
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a href="#" class="avatar avatar-sm mr-2">
                                            <img class="avatar-img rounded-circle" src="{{ ($speciality->pic && file_exists('public/storage/images/specialities/'.$speciality->pic)) ? asset('public/storage/images/specialities/'.$speciality->pic) : asset('public/storage/images/specialities/speciality-icon.png') }}" alt="{{ $speciality->spec_name }}">
                                        </a>
                                        <a href="#">{!! $speciality->spec_name !!}</a>
                                    </h2>
                                </td>
                                <td>
                                    <div class="status-toggle">
                                        <input type="checkbox" id="status_{!! $speciality->id !!}" data-id = "{!! $speciality->id !!}" class="speciality check" {{ ($speciality->status == 'Active')? 'checked': '' }}>
                                        <label for="status_{!! $speciality->id !!}" class="checktoggle">checkbox</label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('Speciality.edit', ['id'=>$speciality->id])}}">Edit Speciality</a>
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
    var change_speciality_status = "{{ route('change.speciality.status') }}";
</script>
@endsection
