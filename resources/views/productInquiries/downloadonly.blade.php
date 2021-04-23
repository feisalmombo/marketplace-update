@extends('layouts.app')

@section('title', 'View Download Inquiries')

@section('content')

<div class="col-lg-12">
<h1 class="page-header">All Download Inquiries</h1>
</div>

<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
    List of download inquiries
    <a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
</div>
<div class="panel-body table-responsive">
    @if(count($downloadOnlyDatas)>0)
    <table id="example1" class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Date</th>
                <th>Email</th>

            </tr>
        </thead>
        <tbody>

            @foreach($downloadOnlyDatas as $key=>$productinqury)
            <tr class="odd gradeX">
            <td>{{ $key + 1 }}</td>
            <td>{{ $productinqury->full_name}}</td>
            <td>{{ $productinqury->phone_number}}</td>
            <td>{{ $productinqury->created_at}}</td>
            <td>{{ $productinqury->email}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No Download Inquiries found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
