@extends('layouts.app')

@section('title', 'View Product Inquiries')

@section('content')

<div class="col-lg-12">
<h1 class="page-header">All Product Inquiries</h1>
</div>

<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
    List of product inquiries
    <a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
</div>
<div class="panel-body table-responsive">
    @if(count($productinquiries)>0)
    <table id="example1" class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Date</th>
                <th>Email</th>
                <th>From</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>

            @foreach($productinquiries as $key=>$productinqury)
            <tr class="odd gradeX">
            <td>{{ $key + 1 }}</td>
            <td>{{ $productinqury->full_name}}</td>
            <td>{{ $productinqury->phone_number}}</td>
            <td>{{ $productinqury->created_at}}</td>
            <td>{{ $productinqury->email}}</td>
            <td>{{ $productinqury->product_inquiries_status}}</td>
            <td>
                <a href='#{{ $productinqury->id }}' data-toggle="modal" type="button" class="btn btn-danger"><i class="fa fa-trash" arial-hidden="true"></i></a>
                <div class="modal fade" id="{{ $productinqury->id }}">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><strong>Delete</strong></h4>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete Product Inquiries with Name? <h9 style="color: blue;">{{ $productinqury->full_name }}</h9>
                            </div>
                            <form action="/product/inquries/{{ $productinqury->id  }}" method="POST" role="form">

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
        <strong>No Product Inquiries found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
