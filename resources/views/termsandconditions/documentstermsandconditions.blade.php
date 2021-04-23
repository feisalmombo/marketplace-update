@extends('layouts.app')

@section('title', 'View Documents')

@section('content')

<div class="col-lg-12">
<h1 class="page-header">View Documents Uploads</h1>
</div>
<section class="content">
<div class="row">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
    <div class="panel-heading">
        List of all documents uploads
        <a href="{{ url('/documents/terms/conditions/create') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-upload"></i>&nbsp;Upload Documents</a>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
         @if(count($documentsDatas)>0)

        <div class="box-body table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>S/N</th>
                <th>File Name</th>
                <th>File Path</th>
                <th>View</th>
                <th>Duration</th>
            </tr>
            </thead>
            <tbody>
                     @foreach($documentsDatas as $key=>$documentsData)
                    <tr class="odd gradeX">
                        <td>{{ $key + 1 }}</td>
                        <td class="center">{{ $documentsData->name }}</td>
                        <td class="center">{{ $documentsData->file_path }}</td>
                        <td class="center">
                            <a href="{{ Storage::url($documentsData->file_path) }}" target="_blank" type="button" class="btn btn-primary">View</a>
                        </td>
                        <td class="center">{{date("F jS, Y", strtotime($documentsData->created_at))}}</td>
                    </tr>
                     @endforeach
                </tbody>
            </table>
        </div>
         @else
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>No Documents Uploads</strong>
        </div>
        @endif
    </div>
</div>
</div>
</div>
</section>
@endsection


