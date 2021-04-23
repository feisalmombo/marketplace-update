@extends('layouts.app')

@section('title', 'View Institution Types')

@section('content')

<div class="col-lg-12">
<h1 class="page-header">All Institution Types</h1>
</div>

<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
    List of institution types
    <a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
</div>
<div class="panel-body table-responsive">
    @if(count($institutionTypes)>0)
    <table id="example1" class="table table-bordered table-striped table-responsive">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Institution Type Name</th>
                <th>Created Day</th>

            </tr>
        </thead>
        <tbody>

            @foreach($institutionTypes as $key=>$institutionType)
            <tr class="odd gradeX">
            <td>{{ $key + 1 }}</td>
            <td>{{ $institutionType->institution_type_name}}</td>
            <td>{{date("F jS, Y", strtotime($institutionType->created_at))}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No Institution Types found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
