@extends('layouts.app')

@section('title', 'Subscribers')

@section('content')


<div class="col-lg-12">
<h1 class="page-header">All Subscribers</h1>
</div>
<section class="content">
<div class="row">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
    List of all Subscribers
    <a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>

</div>
<!-- /.panel-heading -->
<div class="panel-body table-responsive">
    @if(count($subscribers)>0)

    <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>S/N</th>
            <th>Email</th>
            <th>Created at</th>
            <th>Show</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
                @foreach($subscribers as $key=>$subscriber)
                <tr class="odd gradeX">
                <td>{{ $key + 1 }}</td>
                <td class="center">{{ $subscriber->subscribers_email }}</td>
                <td class="center">{{date("F jS, Y", strtotime($subscriber->created_at))}}</td>
                <td>
                    <a href="/subscriber-email/{{ $subscriber->id }}"><button type="button" class="btn btn-primary">Show</button></a>
                </td>
                <td>
                    <a href='#{{ $subscriber->id }}' data-toggle="modal" type="button" class="btn btn-danger"><i class="fa fa-trash" arial-hidden="true"></i></a>
                    <div class="modal fade" id="{{ $subscriber->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title"><strong>Delete</strong></h4>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete subscriber Email? <h9 style="color: blue;">{{ $subscriber->subscribers_email }}</h9>
                                </div>
                                <form action="/subscriber-email/{{ $subscriber->id  }}" method="POST" role="form">

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
    </div>
    @else
    <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>No Subscriber found</strong>
    </div>
    @endif
</div>
</div>
</div>
</div>
</section>
@endsection
