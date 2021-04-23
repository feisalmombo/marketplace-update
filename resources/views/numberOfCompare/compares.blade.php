@extends('layouts.app')

@section('title', 'View Compare Loans')

@section('content')

<div class="col-lg-12">
<h1 class="page-header">All Compare Loans</h1>
</div>

<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
    List of compare loans
    <a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
</div>
<div class="panel-body table-responsive">
    @if(count($compareLoans)>0)
    <table id="example1" class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Loan Amount</th>
                <th>Duration</th>
                <th>Net Salary</th>
                <th>Loan Name</th>
                <th>Created Day</th>

            </tr>
        </thead>
        <tbody>

            @foreach($compareLoans as $key=>$compareLoan)
            <tr class="odd gradeX">
            <td>{{ $key + 1 }}</td>
            <td>{{ $compareLoan->loan_amount}}</td>
            <td>{{ $compareLoan->duration}}</td>
            <td>{{ $compareLoan->net_salary}}</td>
            <td>{{ $compareLoan->loan_name}}</td>
            <td>{{date("F jS, Y", strtotime($compareLoan->created_at))}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No Compare Loans found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
