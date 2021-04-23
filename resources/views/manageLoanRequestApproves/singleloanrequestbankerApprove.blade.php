@extends('layouts.app')

@section('title', 'Borrower Loan Approved by Banker')

@section('content')


<div class="col-lg-12">
<h1 class="page-header">Borrower Loan Approved by Banker</h1>
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
     @if(count($singleLoanApprovedByBankers)>0)

    <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>S/N</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Bank</th>
            <th>Loan Name</th>
            <th>Status</th>
            <th>City</th>
            <th>Created at</th>
        </tr>
        </thead>
        <tbody>
                 @foreach($singleLoanApprovedByBankers as $key=>$singleLoanApprovedByBanker)
                <tr class="odd gradeX">
                <td>{{ $key + 1 }}</td>
                <td class="center">{{ $singleLoanApprovedByBanker->full_name}}</td>
                <td class="center">{{ $singleLoanApprovedByBanker->email}}</td>
                <td class="center">{{ $singleLoanApprovedByBanker->phone_number}}</td>
                <td class="center">{{ $singleLoanApprovedByBanker->institution_name}}</td>
                <td class="center">{{ $singleLoanApprovedByBanker->loan_name}}</td>
                <td class="center" style="color: #6cc070">{{ $singleLoanApprovedByBanker->loan_requests_status}}</td>
                <td class="center">{{ $singleLoanApprovedByBanker->city_name}}</td>
                <td class="center">{{date("F jS, Y", strtotime($singleLoanApprovedByBanker->created_at))}}</td>
                </tr>
                 @endforeach
            </tbody>
        </table>
    </div>
     @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No Borrower Loan Approved by Banker not found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
