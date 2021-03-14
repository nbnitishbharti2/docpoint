@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Add Reason</h4>
			</div>
			<div class="card-body">
				<form method ="POST" enctype='multipart/form-data' id="reason-form" action="{{route('reason.store')}}">
					@csrf

					<div class="form-group row">
						<label class="col-form-label col-md-2">Specialty*</label>
						<div class="col-md-10">
							<select name ="speciality_id" class="form-control">
								<option value="">Select Speciality</option>
								@php $specialities = \App\Models\Speciality::getSpecialities(); @endphp
								@foreach ($specialities as $key=>$speciality)
									<option value="{{$key}}" {{ (old("speciality_id") == $key ? "selected":"") }}> {{ $speciality }}</option>
								@endforeach
							</select>
							@error('speciality_id')
							<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>

					<div class="form-group row">
						<label class="col-form-label col-md-2">Name*</label>
						<div class="col-md-10">
							<input name ="name" type="text" class="form-control" id="name" value="{{ old('name') }}">
							@error('name')
							<span class="text-danger">{{ $message }}</span>
							@enderror
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-form-label col-md-2">Status</label>
						<div class="col-md-10">
							<div class="checkbox">
								@if(Auth::user()->doctors == null) 
								<select name="status" class="form-control" value="{{ old('status') }}">
                                    @php $options = \App\Models\Reason::getStatusOption(); @endphp
                                    @foreach($options as $key=>$value)
									<option {{old('status') == $key ? 'selected' : '' }} value="{{ $key }}"  > {{ $value }}</option>
                                    @endforeach
								</select>
								@else
								<input type="text" name="status" class="form-control" value="New" readonly />
								@endif
								@error('status')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>
					<div class="text-right">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection
@section('script')
<script>
	var get_state = "{{ route('get.country.state') }}";
	var get_city = "{{ route('get.state.city') }}";
</script>
<script  src="{{ asset('public/admin/assets/js/custom.js')}}"></script>
@endsection