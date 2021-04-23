@extends('layouts.app')

@section('title', 'All Rejected and Approved')

@section('content')


<div class="col-lg-12">
<h1 class="page-header">All Rejected and Approved</h1>
</div>
<section class="content">
<div class="row">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">

    Home<a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>


</div>
<!-- /.panel-heading -->
<div class="panel-body table-responsive">
    @if(count($totalrejectedApprovedDatas)>0)

    <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>S/N</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Date of Birth</th>
            <th>NIDA Number</th>
            <th>City</th>
            <th>Product Name</th>
            <th>Institution Name</th>
            <th>Institution Type Name</th>
            <th>Loan Type</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created at</th>
        </tr>
        </thead>
        <tbody>
                @foreach($totalrejectedApprovedDatas as $key=>$totalrejectedApprovedData)
                <tr class="odd gradeX">
                <td>{{ $key + 1 }}</td>
                <td class="center">{{ $totalrejectedApprovedData->full_name }}</td>
                <td class="center">{{ $totalrejectedApprovedData->email }}</td>
                <td class="center">{{ $totalrejectedApprovedData->phone_number }}</td>
                <td class="center">{{ $totalrejectedApprovedData->date_of_birth }}</td>
                <td class="center">{{ $totalrejectedApprovedData->government_id_number }}</td>
                <td class="center">{{ $totalrejectedApprovedData->city }}</td>
                <td class="center">{{ $totalrejectedApprovedData->product_name }}</td>
                <td class="center">{{ $totalrejectedApprovedData->institution_name }}</td>
                <td class="center">{{ $totalrejectedApprovedData->institution_type_name }}</td>
                <td class="center">{{ $totalrejectedApprovedData->loan_name }}</td>
                <td class="center">{{ $totalrejectedApprovedData->loan_requests_description }}</td>
                <td class="center" style="color:red">{{ $totalrejectedApprovedData->loan_requests_status }}</td>
                <td class="center">{{date("F jS, Y", strtotime($totalrejectedApprovedData->created_at))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No All Rejected and Approved found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
