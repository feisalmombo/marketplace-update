@extends('layouts.app')

@section('title', 'Loan Applied')

@section('content')


<div class="col-lg-12">
<h1 class="page-header">All Loan Applied</h1>
</div>
<section class="content">
<div class="row">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
    List of all loan applied

    Home<a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>

</div>
<!-- /.panel-heading -->
<div class="panel-body table-responsive">
    @if(count($loanapplied)>0)

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
            {{-- <th>Other Loan</th> --}}
            <th>Applied Status</th>
            <th>Institution Name</th>
            <th>Institution Type Name</th>
            <th>Product Name</th>
            <th>Loan Type</th>
            <th>Created at</th>
        </tr>
        </thead>
        <tbody>
                @foreach($loanapplied as $key=>$loanapplieds)
                 <tr class="odd gradeX">
                    <td>{{ $key + 1 }}</td>
                    <td class="center">{{ $loanapplieds->full_name }}</td>
                    <td class="center">{{ $loanapplieds->email }}</td>
                    <td class="center">{{ $loanapplieds->phone_number }}</td>
                    <td class="center">{{ $loanapplieds->date_of_birth }}</td>
                    <td class="center">{{ $loanapplieds->government_id_number }}</td>
                    <td class="center">{{ $loanapplieds->city }}</td>
                    {{-- <td class="center">{{ $loanapplieds->status }} {{ $loanapplieds->institution_name }}</td> --}}
                    <td class="center" style="color:#003663">{{ $loanapplieds->applied_status }}</td>
                    <td class="center">{{ $loanapplieds->institution_name }}</td>
                    <td class="center">{{ $loanapplieds->institution_type_name }}</td>
                    <td class="center">{{ $loanapplieds->product_name }}</td>
                    <td class="center">{{ $loanapplieds->loan_name }}</td>
                    <td class="center">{{date("F jS, Y", strtotime($loanapplieds->created_at))}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No Loan Applied found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
