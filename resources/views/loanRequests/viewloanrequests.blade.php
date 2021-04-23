@extends('layouts.app')

@section('title', 'Loan Requests')

@section('content')


<div class="col-lg-12">
<h1 class="page-header">All Loan Requests</h1>
</div>
<section class="content">
<div class="row">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
    List of all loan requests

    <a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>

</div>
<!-- /.panel-heading -->
<div class="panel-body">
    @if(count($loanrequests)>0)

    <div class="box-body table-responsive">
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
            <th>Status</th>
            <th>Institution Name</th>
            <th>Institution Type Name</th>
            <th>Product Name</th>
            <th>Loan Type</th>
            <th>Created at</th>
            <th>Show</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
                @foreach($loanrequests as $key=>$loanrequest)
                <tr class="odd gradeX">
                <td>{{ $key + 1 }}</td>
                <td class="center">{{ $loanrequest->full_name }}</td>
                <td class="center">{{ $loanrequest->email }}</td>
                <td class="center">{{ $loanrequest->phone_number }}</td>
                <td class="center">{{ $loanrequest->date_of_birth }}</td>
                <td class="center">{{ $loanrequest->government_id_number }}</td>
                <td class="center">{{ $loanrequest->city }}</td>
                <td class="center" style="color:#003663">{{ $loanrequest->applied_status }}</td>
                <td class="center">{{ $loanrequest->institution_name }}</td>
                <td class="center">{{ $loanrequest->institution_type_name }}</td>
                <td class="center">{{ $loanrequest->product_name }}</td>
                <td class="center">{{ $loanrequest->loan_name }}</td>
                <td class="center">{{date("F jS, Y", strtotime($loanrequest->created_at))}}</td>
                <td>
                    <a href="/loan/requests/{{ $loanrequest->id }}"><button type="button" class="btn btn-primary">Show</button></a>
                </td>
                <td>
                    <a href='#{{ $loanrequest->id }}' data-toggle="modal" type="button" class="btn btn-danger"><i class="fa fa-trash" arial-hidden="true"></i></a>
                    <div class="modal fade" id="{{ $loanrequest->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><strong>Delete</strong></h4>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete loan requests with full name? <h9 style="color: blue;">{{ $loanrequest->full_name }}</h9>
                                </div>
                                <form action="/loan/requests/{{ $loanrequest->id  }}" method="POST" role="form">

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
                {{-- @endif --}}
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No Loan Requests found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
