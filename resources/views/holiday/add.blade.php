@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add Holiday</h4>
            </div>
            <div class="card-body">
                <form method = "POST" action = "{{ route('store.holiday') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-form-label col-md-2">Date*</label>
                        <div class="col-md-10">
                            <input name ="date" required type="text" class="form-control" id="date" value="{{ old('date') }}">
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
<script  src="{{ asset('public/admin/assets/js/custom.js')}}"></script>
<script>
$(function(){
    $('#date').datepicker({
        format: 'dd-mm-yyyy',
        orientation: "bottom"
    });
});
</script>
@endsection