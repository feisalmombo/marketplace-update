@extends('layouts.app')

@section('title', 'Show Loan Requests')

@section('content')
<div class="col-lg-12">
<h1 class="page-header">Show Loan Requests</h1>
</div>

<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
List of all loan requests <a href="{{ url('/loan/requests') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
</div>
<div class="panel-body">
<div class="container-fluid pull-left">
<section class="container center-block">
<div class="container-page">
<div class="col-md-10">

    <div class="panel panel-primary">
        <div class="panel-heading">{{ $loanrequest->full_name }}
        </div>

        <div class="panel-body">
            <form  class="form-horizontal " role="form" style="font-size: 17px; padding: 40px;">

                <div class="form-group">
                    <label>Borrower Name:</label>
                    <p>{{ $loanrequest->full_name }}</p>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <p>{{ $loanrequest->email }}</p>
                </div>
                <div class="form-group">
                    <label>Phone Number:</label>
                    <p>{{ $loanrequest->phone_number }}</p>
                </div>
                <div class="form-group">
                    <label>NIDA Number:</label>
                    <p>{{ $loanrequest->government_id_number }}</p>
                </div>
                <div class="form-group">
                    <label>Duration:</label>
                    <p>{{ $loanrequest->created_at->diffForHumans() }}</p>
                </div>
            </form>

            <!-- Reply Button l -->
           <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalNorm">
            Add
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
                        Borrower Name:<p style="color: blue;"> {{ $loanrequest->full_name }}</p>
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <form role="form" action="{{ url('/loan/requests/post') }}" method="POST">
                    <input type="hidden" value="{{$borrowerId}}" name="borrowerId">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="phone_number">Phone</label>
                        <input type="tel" class="form-control"
                        id="phone_number"  name="phone_number" value="{{ $loanrequest->phone_number }}" />
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control"
                        id="email"  name="email" value="{{ $loanrequest->email }}" />
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                       <textarea class="form-control" required="required" name="description" placeholder="eg: Give your reason here"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="requestsStatus">Loan Request Status</label>
                        <select class="form-control"  required="required" name="requestsStatus">
                            <option value="">-- Select status --</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="requestsStatus">Loan Criteria</label>
                        <br>
                        <input type="checkbox" id="id_number" name="id_number" value="" required>
                        <label for="id_number">ID Number - {{ $loanrequest->government_id_number }}</label><br>

                        <input type="checkbox" id="address" name="address" value="" required>
                        <label for="address"> Current Address - {{ $eligibilities->city }}</label><br>

                        <input type="checkbox" id="phonenumber" name="phonenumber" value="" required>
                        <label for="phonenumber"> Valid Phone number (+255) - {{ $loanrequest->phone_number }}</label><br>

                        <input type="checkbox" id="eligibility" name="eligibility" value="" required>
                        <label for="eligibility">{{ $eligibilities->eligibility }}</label><br>
                    </div>

                    <button type="submit" class="btn btn-primary">Post</button>
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
</section>
</div>
</div>
</div>
</div>
</div>
</section>

@endsection
