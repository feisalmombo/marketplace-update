@extends('layouts.app')

@section('title', 'All Loan Request Approve with Pending status')

@section('content')


<div class="col-lg-12">
<h1 class="page-header">All Loan Request Approve with Pending status</h1>
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
     @if(count($loanRequestApproves)>0)

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
            <th>Action</th>
            <th>Created at</th>
        </tr>
        </thead>
        <tbody>
                 @foreach($loanRequestApproves as $key=>$loanRequestApprove)
                <tr class="odd gradeX">
                <td>{{ $key + 1 }}</td>
                <td class="center">{{ $loanRequestApprove->full_name}}</td>
                <td class="center">{{ $loanRequestApprove->email}}</td>
                <td class="center">{{ $loanRequestApprove->phone_number}}</td>
                <td class="center">{{ $loanRequestApprove->institution_name}}</td>
                <td class="center">{{ $loanRequestApprove->loan_name}}</td>
                <td class="center" style="color: #EA8E37">{{ $loanRequestApprove->loan_requests_status}}</td>
                <td class="center">{{ $loanRequestApprove->city_name}}</td>
                <td>
                    <a href="/loan/request/approves/{{ $loanRequestApprove->id }}"><button type="button" class="btn btn-primary">Show</button></a>
                </td>
                <td class="center">{{date("F jS, Y", strtotime($loanRequestApprove->created_at))}}</td>
                </tr>
                 @endforeach
            </tbody>
        </table>
    </div>
     @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No All Loan Request Approve with Pending status not found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
