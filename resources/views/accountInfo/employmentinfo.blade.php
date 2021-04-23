@extends('layouts.app')

@section('title', 'Employment Information')

@section('content')
<div class="col-lg-12">
    <h1 class="page-header">All Employment Information</h1>
</div>
<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
    List of employment Information
    <a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>

</div>
<div class="panel-body table-responsive">
    @if(count($employmentDatas)>0)
    <table id="example1" class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Workplace</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Net Salary (Monthly)</th>
                <th>Title</th>
                <th>Created at</th>

            </tr>
        </thead>
        <tbody>

            @foreach($employmentDatas as $key=>$employmentData)
            <tr class="odd gradeX">
            <td>{{$key + 1 }}</td>
            <td>{{$employmentData->workplace}}</td>
            <td>{{$employmentData->address}}</td>
            <td>{{$employmentData->phone_number}}</td>
            <td>{{$employmentData->net_salary}}</td>
            <td>{{$employmentData->job_title}}</td>
            <td>{{$employmentData->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No Employment Information found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
