@extends('layouts.app')

@section('title', 'Loan Pending')

@section('content')


<div class="col-lg-12">
<h1 class="page-header">All Loan Pending</h1>
</div>
<section class="content">
<div class="row">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
    List of all loan pending
    <a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>


</div>
<!-- /.panel-heading -->
<div class="panel-body table-responsive">
    @if(count($loanpending)>0)

    <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone number</th>
            <th>Product Name</th>
            <th>Product Code</th>
            <th>Institution Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created at</th>
        </tr>
        </thead>
        <tbody>
                @foreach($loanpending as $key=>$loanpend)
                <tr class="odd gradeX">
                <td>{{ $key + 1 }}</td>
                <td class="center">{{ $loanpend->full_name }}</td>
                <td class="center">{{ $loanpend->email }}</td>
                <td class="center">{{ $loanpend->phone_number }}</td>
                <td class="center">{{ $loanpend->product_name }}</td>
                <td class="center">{{ $loanpend->product_code }}</td>
                <td class="center">{{ $loanpend->institution_name }}</td>
                <td class="center">{{ $loanpend->loan_requests_description }}</td>
                <td class="center" style="color: #EA8E37">{{ $loanpend->loan_requests_status }}</td>
                <td class="center">{{date("F jS, Y", strtotime($loanpend->created_at))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No Loan Pending found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
