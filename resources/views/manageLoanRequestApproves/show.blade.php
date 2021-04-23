@extends('layouts.app')

@section('title', 'Show Loan request Approve')

@section('content')

<div class="col-lg-12">
	<h1 class="page-header">Show Loan request Approve</h1>
</div>
<section class="content">
    <div class="row">
       <div class="col-lg-12">
        @include('msgs.success')

        <div id="alert-info"></div>

        <div class="panel panel-default">
         <div class="panel-heading">
            List Loan request Approve <a href="{{ url('/loan/request/approves') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
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
                                            <label>Name:</label>
                                            <p>{{ $loanRequestApprove->full_name }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Phone Number:</label>
                                            <p>{{ $loanRequestApprove->phone_number }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Bank:</label>
                                            <p>{{ $loanRequestApprove->institution_name }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Loan Name:</label>
                                            <p>{{ $loanRequestApprove->loan_name }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Delivered:</label>
                                            <p>{{ $loanRequestApprove->created_at}}</p>
                                        </div>
                                    </form>

                                    <!-- Reply Button l -->
                                   <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalNorm">
                                    Send
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
                                                Send a Successfully Email for all approved request for borrower <p style="color: blue;"> {{ $loanRequestApprove->full_name }}</p>
                                            </h4>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">

                                            <form role="form" action="{{ url('/loan/request/approves/send') }}" method="POST">

                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control"
                                                id="email"  name="email" value="{{ $loanRequestApprove->email }}" />
                                            </div>

                                            <div class="form-group">
                                                <label for="phone_number">Phone Number</label>
                                                <input type="tel" class="form-control"
                                                id="phone_number" name="phone_number" value="{{ $loanRequestApprove->phone_number }}" />
                                            </div>

                                            <div class="form-group">
                                                <label for="description">Description</label>
                                               <textarea class="form-control" required="required" name="description" placeholder="eg: Give your reason here"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="requestsStatus">Loan Request Status</label>
                                                <select class="form-control"  required="required" name="requestsStatus">
                                                    <option value="">-- Select status --</option>
                                                    <option value="Approved">Approved</option>
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Submit now</button>
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
