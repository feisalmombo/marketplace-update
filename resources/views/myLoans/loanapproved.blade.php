@extends('layouts.app')

@section('title', 'Loan Approved')

@section('content')


<div class="col-lg-12">
<h1 class="page-header">All Loan Approved</h1>
</div>
<section class="content">
<div class="row">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
    List of all loan approved

    Home<a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>


</div>
<!-- /.panel-heading -->
<div class="panel-body table-responsive">
    @if(count($loanapproved)>0)

    <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>S/N</th>
            <th>Product Name</th>
            <th>Product Code</th>
            <th>Institution Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created at</th>
        </tr>
        </thead>
        <tbody>
                @foreach($loanapproved as $key=>$loanapproveds)
                <tr class="odd gradeX">
                <td>{{ $key + 1 }}</td>
                <td class="center">{{ $loanapproveds->product_name }}</td>
                <td class="center">{{ $loanapproveds->product_code }}</td>
                <td class="center">{{ $loanapproveds->institution_name }}</td>
                <td class="center">{{ $loanapproveds->loan_requests_description }}</td>
                <td class="center">{{ $loanapproveds->loan_requests_status }}</td>
                <td class="center">{{date("F jS, Y", strtotime($loanapproveds->created_at))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No Loan Approved found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
