@extends('layouts.backend')
@section('content')
@include('layouts.message')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Doctor</h4>
                </div>
                <div class="card-body">
					<form method="POST" enctype='multipart/form-data' id="doctor-form" action="{{ route('doctor.update', ['id' => $id]) }}">
						@csrf
						<div class="form-group row">
							<label class="col-form-label col-md-2">Full Name*</label>
							<div class="col-md-10">
								<input type="hidden" name="user_id" value="{{ $docDetails->user_id }}">
								<input name="name" type="text" class="form-control" id="name" value="{{ old('name', $docDetails->name) }}">
								@error('name')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-2">Email*</label>
							<div class="col-md-10">
								<input name="email" type="email" class="form-control" value="{{ old('email', $docDetails->email) }}">
								@error('email')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-form-label col-md-2">Specialty*</label>
							<div class="col-md-10">
								<select name ="speciality" class="form-control" value="{{ old('speciality') }}">
									<option>Select Specialty</option>
									@foreach ($specialities as $speciality)
										<option value="{{ $speciality->id }}" {{ ($docDetails->speciality_id == $speciality->id ? "selected":"") }}> {{ $speciality->spec_name }}</option>
									@endforeach
								</select>
								@error('speciality')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-form-label col-md-2">Mobile Number*</label>
							<div class="col-md-10">
								<input name="mobile" type="text" maxlength="10" class="form-control" value="{{ old('mobile', $docDetails->mobile) }}">
								@error('mobile')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-2">Phone Number</label>
							<div class="col-md-10">
								<input name="phone" type="text" class="form-control" value="{{ old('phone', $docDetails->phone) }}">
								@error('phone')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-form-label col-md-2">Alternate Mobile</label>
							<div class="col-md-10">
								<input name="alt_moblie" type="text" maxlength="10" class="form-control" value="{{ old('alt_moblie', $docDetails->alt_moblie) }}">
								@error('alt_moblie')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-form-label col-md-2">Fax Number</label>
							<div class="col-md-10">
								<input name="fax" type="text" class="form-control" value="{{ old('fax', $docDetails->fax) }}">
								@error('fax')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-2">Gender*</label>
							<div class="col-md-10">
								<select name ="gender" class="form-control">
									<option disabled="" selected="">Select Gender</option>
									@foreach($genders as $gender)
										<option value="{{$gender->id}}" {{ ($docDetails->gender_id == $gender->id ? "selected":"") }}> {{ $gender->name }}</option>
									@endforeach
								</select>
								@error('gender')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-2">Choose Profile Pic</label>
							<div class="col-md-10">
								<input name='pic' class="form-control" type="file">
								@error('pic')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-2">About</label>
							<div class="col-md-10">
								<textarea name="about" rows="5" cols="5" class="form-control"
									placeholder="Enter text here">{{ old('about', $docDetails->about) }}</textarea>
								@error('about')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-form-label col-md-2">Country</label>
							<div class="col-md-10">
								<select name ="country" id="country" class="form-control">
									<option>Select Country</option>
									@foreach($countries as $country)
										<option value="{{ $country->id }}" {{ ($docDetails->country_id == $country->id ? "selected":"") }}>{{ $country->name }}</option>
									@endforeach
								</select>
								@error('country')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-2">State</label>
							<div class="col-md-10">
								<select name ="state" id="state" class="form-control">
									<option>Select States</option>
									@foreach ($states as $state)
										<option value="{{ $state->id }}" {{ ($docDetails->state_id == $state->id ? "selected":"") }}>{{ $state->name }}</option>
									@endforeach
								</select>
								@error('state')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
	
						<div class="form-group row">
							<label class="col-form-label col-md-2">City</label>
							<div class="col-md-10">
								<select name ="city" id="city" class="form-control">
									<option>Select City</option>
									@foreach ($cities as $city)
										<option value="{{ $city->id }}" {{ ($docDetails->city_id == $city->id ? "selected":"") }}>{{ $city->name }}</option>
									@endforeach
								</select>
								@error('city')
								<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-2">Address*</label>
							<div class="col-md-10">
								<textarea name="address" rows="5" cols="5" class="form-control"
									placeholder="Enter text here">{{ old('address', $docDetails->address) }}</textarea>
								@error('address')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-form-label col-md-2">Pincode</label>
							<div class="col-md-10">
								<input name="zip" type="text" class="form-control" value="{{ old('zip', $docDetails->zip) }}">
								@error('zip')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
						

						<div class="form-group row">
							<label class="col-form-label col-md-2">Latitude</label>
							<div class="col-md-10">
								<input name="lat" type="text" class="form-control" value="{{ old('lat', $docDetails->latitude) }}">
								@error('lat')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-form-label col-md-2">Longitude</label>
							<div class="col-md-10">
								<input name="long" type="text" class="form-control" value="{{ old('long', $docDetails->longitude) }}">
								@error('long')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label class="col-form-label col-md-2">Website</label>
							<div class="col-md-10">
								<input name="website" type="text" class="form-control"
									value="{{ old('website', $docDetails->website) }}">
								@error('website')
									<span class="text-danger">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="form-group row">
							<label class="col-form-label col-md-2">Status</label>
							<div class="col-md-10">
								<div class="checkbox">
									<label>
										<input name="status" type="checkbox" {{ ($docDetails->status === 'Active')?"checked":'' }}>&nbsp;Status&nbsp;&nbsp;&nbsp;
									</label>
									<label>
										<input name="physical" type="checkbox" {{ ($docDetails->physical === 'Yes')?"checked":'' }}>&nbsp; Physical&nbsp;&nbsp;&nbsp;
									</label>
									<label>
										<input name="video" type="checkbox" {{ ($docDetails->video === 'Yes')?"checked":'' }}>&nbsp; Video&nbsp;&nbsp;&nbsp;
									</label>
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
</div>
@endsection
@section('script')
<script>
	var get_state = "{{ route('get.country.state') }}";
	var get_city = "{{ route('get.state.city') }}";
</script>
<script  src="{{ URL::asset('public/admin/assets/js/custom.js')}}"></script>
@endsection