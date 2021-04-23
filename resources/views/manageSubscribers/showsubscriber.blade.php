@extends('layouts.app')

@section('title', 'Show Email')

@section('content')

<div class="col-lg-12">
	<h1 class="page-header">Show Email</h1>
</div>
<section class="content">
    <div class="row">
       <div class="col-lg-12">
        @include('msgs.success')

        <div id="alert-info"></div>

        <div class="panel panel-default">
         <div class="panel-heading">
            List of all subscribers <a href="{{ url('/subscriber-email') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="">
               <div class="">

                <div class="panel-body">
                    <div class="">
                        <div class="" id="incident">
                            <div class="row">
                                <div class="panel-body">
                                    <form  class="form-horizontal " role="form" style="font-size: 17px; padding: 40px;">

                                        <div class="form-group">
                                            <label>Email:</label>
                                            <p>{{ $subscriber->subscribers_email }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Delivered:</label>
                                            <p>{{ $subscriber->created_at->diffForHumans() }}</p>
                                        </div>
                                    </form>

                                    <!-- Reply Button l -->
                                   <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalNorm">
                                    Reply
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                data-dismiss="modal">
                                                <span aria-hidden="true">&times;</span>
                                                <span class="sr-only">Close</span>
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">
                                                Reply Message to <p style="color: blue;"> {{ $subscriber->subscribers_email }}</p>
                                            </h4>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">

                                            <form role="form" action="{{ url('/subscriber-email/send') }}" method="POST">

                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="email">To</label>
                                                <input type="email" class="form-control"
                                                id="to"  name="to" value="{{ $subscriber->subscribers_email }}" />
                                            </div>
                                              <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control"
                                                id="title" placeholder="Enter Title" name="title" />
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Message</label>
                                               <textarea class="form-control" name="messageinfo"></textarea>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Reply now</button>
                                        </form>

                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                        data-dismiss="modal">
                                        Close
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

     </div>

 </div>

 <!-- /.panel-body -->
</div>
<!-- /.panel -->
</div>
<!-- /.col-lg-6 -->
</div>
<!-- /.col-lg-6 -->
</div>
</section>
@endsection
