@extends('layouts.backend')
@section('content')
@include('layouts.message')
<div class="page-header">
    <div class="row">
        <div class="col-sm-12">
        <div class="user-grp-container">
            <h3 class="page-title">Reviews</h3>
             
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
                                <th>Doctor name</th>
                                <th>Patent Name</th>
                                <th>Rate</th>
                                <th>Title </th>
                                <th>Description</th>
                                <th>Action</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $value)
                            <tr>
                                <td>{{$value->doctor->name}}</td>
                                <td>{{$value->patient->name}}</td>
                                <td>{{$value->rate}}</td>
                                <td>{{$value->review_title}}</td>
                                <td>{{$value->review_desc}}</td>
                                <td>
                                    @if($value->status==0)
                                    <a class="btn btn-success" href="{{route('change-review',['id'=>$value->id,'status'=>1])}}">Approve</a>
                                    <a class="btn btn-danger" href="{{route('change-review',['id'=>$value->id,'status'=>2])}}">Reject</a>
                                    @elseif($value->status==1)
                                        Approved
                                    @elseif($value->status==2)
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