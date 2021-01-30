@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
            <div class="user-grp-container">
                <h3 class="page-title">Reviews</h3>
            </div>
            <ul class="breadcrumb"></ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="datatable table table-hover table-center mb-0" id="review_table">
                        <thead>
                            <tr>
                                <th>Doctor name</th>
                                <th>Patent Name</th>
                                <th>Rate</th>
                                <th style="width: 55% !important;">Description</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reviews as $value)
                                <tr>
                                    <td>{{ $value->doctor->name }}</td>
                                    <td>{{ $value->user->name }}</td>
                                    <td>{{ $value->rate }}</td>
                                    <td>{{ $value->review_desc }}</td>
                                    <td style="width: 55% !important;">
                                        @if($value->status == 'New')
                                            <a class="btn btn-success" href="{{route('change-review',['id'=>$value->id,'status'=> 'Approved'])}}" title="Approve"><i class="fa fa-check" aria-hidden="true"></i>
                                            </a>
                                            <a class="btn btn-danger" href="{{route('change-review',['id'=>$value->id,'status'=> 'Rejected'])}}" title="Reject"><i class="fa fa-times"></i>
                                            </a>
                                        @elseif($value->status == 'Approved')
                                            Approved
                                        @elseif($value->status == 'Rejected')
                                            Rejected
                                        @endif
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
<style>
    table#review_table{
        table-layout:fixed;
    }     
</style>