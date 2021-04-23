@extends('layouts.app')

@section('title', 'Personal Information')

@section('content')
<div class="col-lg-12">
    <h1 class="page-header">All Personal Information</h1>
</div>
<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
    List of personal Information<a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>

</div>
<div class="panel-body table-responsive">
    @if(count($personalDatas)>0)
    <table id="example1" class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>ID Number</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>DOB</th>
                <th>City</th>
                <th>Created at</th>

            </tr>
        </thead>
        <tbody>

            @foreach($personalDatas as $key=>$personalData)
            <tr class="odd gradeX">
            <td>{{$key + 1 }}</td>
            <td>{{$personalData->full_name}}</td>
            <td>{{$personalData->government_id_number}}</td>
            <td>{{$personalData->phone_number}}</td>
            <td>{{$personalData->email}}</td>
            <td>{{$personalData->date_of_birth}}</td>
            <td>{{$personalData->city}}</td>
            <td>{{$personalData->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No Personal Information found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
