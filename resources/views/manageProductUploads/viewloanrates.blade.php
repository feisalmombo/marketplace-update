@extends('layouts.app')

@section('title', 'View Product Uploads')

@section('content')
<div class="col-lg-12">
    <h1 class="page-header">All Product Uploads</h1>
</div>

<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
    List of product uploads
    <a href="{{ url('/product/uploads/create') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-plus"></i>&nbsp;Product Uploads</a>
</div>
<div class="panel-body table-responsive">
    @if(count($loanrates)>0)
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Institution Name</th>
                <th>Loan Type</th>
                <th>Eligibility</th>
                <th>Minimum Net Salary</th>
                <th>Minimum Amount</th>
                <th>Maximum Amount</th>
                <th>Turn Around Time</th>
                <th>Facility Fee</th>
                <th>Insurance Fee</th>
                <th>Created at</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>

            @foreach($loanrates as $key=>$loanrate)
            <tr class="odd gradeX">
            <td>{{$key + 1 }}</td>
            <td>{{$loanrate->product_name}}</td>
            <td>{{$loanrate->product_code}}</td>
            <td>{{$loanrate->institution_name}}</td>
            <td>{{$loanrate->loan_name}}</td>
            <td>{{$loanrate->eligibility}}</td>
            <td>{{$loanrate->minimum_net_salary}}</td>
            <td>{{$loanrate->minimum_amount}}</td>
            <td>{{$loanrate->maxmum_amount}}</td>
            <td>{{$loanrate->turn_around_time}}</td>
            <td>{{$loanrate->facility_rate}}</td>
            <td>{{$loanrate->insurance_rate}}</td>
            <td>{{$loanrate->created_at}}</td>
            <td>
                <a href="{{ url('product/uploads/'.$loanrate->id.'/edit') }}" type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o" arial-hidden="true"></i></a>
            </td>
            <td>
                <a href='#{{ $loanrate->id }}' data-toggle="modal" type="button" class="btn btn-danger"><i class="fa fa-trash" arial-hidden="true"></i></a>
                <div class="modal fade" id="{{ $loanrate->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><strong>Delete</strong></h4>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete Product Name? <h9 style="color: blue;">{{ $loanrate->product_name }} <strong style="color:black">with</strong> Product Code {{ $loanrate->product_code }}</h9>
                            </div>
                            <form action="/product/uploads/{{ $loanrate->id  }}" method="POST" role="form">

                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>

                                    <button type="submit" class="btn btn-danger">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No Product Uploads found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
