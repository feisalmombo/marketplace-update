@extends('layouts.app')

@section('title', 'Edit Product Uploads')

@section('content')
<div class="col-lg-12">
<h1 class="page-header">Edit Product Uploads</h1>
</div>

<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
Edit Product Uploads <a href="{{ url('/product/uploads') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
</div>
<div class="panel-body">
<div class="container-fluid pull-left">
<section class="container center-block">
<div class="container-page">
<div class="col-md-10">
    <form role="form"  action="{{ url('/product/uploads/'.$productUploads->id) }}" method="POST">

        {{ csrf_field() }}
        {{ method_field('PATCH') }}

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Institution Name</label>
                    <select name="product_id" id="product_id" required="required"  class="form-control">
                        @foreach($productTypes as $productType)
                        <option {{ old('product_id', $productUploads->product_id) == $productType->id ? 'selected' : '' }} value="{{ $productType->id }}">{{ $productType->institution_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-md-8">
                <label>Product Name</label>
                <input type="text" name="product_name" id="product_name" required="required" class="form-control"  value="{{ isset($productUploads->product_name) ? $productUploads->product_name : old('product_name') }}">
            </div>

            <div class="form-group col-md-8">
                <label>Product Code</label>
                <input type="text" name="product_code" id="product_code" required="required" class="form-control"  value="{{ isset($productUploads->product_code) ? $productUploads->product_code : old('product_code') }}">
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Loan Type</label>
                    <select name="loan_type_id" id="loan_type_id" required="required"  class="form-control">
                        @foreach($loanTypes as $loanType)
                        <option {{ old('loan_type_id', $productUploads->loan_type_id) == $loanType->id ? 'selected' : '' }} value="{{ $loanType->id }}">{{ $loanType->loan_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Duration</label>
                    <select name="duration_id" id="duration_id" required="required"  class="form-control">
                        @foreach($durations as $duration)
                        <option {{ old('duration_id', $productUploads->duration_id) == $duration->id ? 'selected' : '' }} value="{{ $duration->id }}">{{ $duration->duration_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group col-md-8">
                <label>Interest Rate</label>
                <input type="text" name="interest_rate" id="interest_rate" required="required" class="form-control"  value="{{ isset($productUploads->interest_rate) ? $productUploads->interest_rate : old('interest_rate') }}">
            </div>

            <div class="form-group col-md-8">
                <label>Minimum Net Salary</label>
                <input type="text" name="minimum_salary" id="minimum_salary" required="required" class="form-control" value="{{ isset($productUploads->minimum_net_salary) ? $productUploads->minimum_net_salary : old('minimum_salary') }}">
            </div>

            <div class="form-group col-md-8">
                <label>Minimum amount</label>
                <input type="text" name="minimum_amount" id="minimum_amount" required="required" class="form-control" value="{{ isset($productUploads->minimum_amount) ? $productUploads->minimum_amount : old('minimum_amount') }}">
            </div>


            <div class="form-group col-md-8">
                <label>Maximum amount</label>
                <input class="form-control" type="text" required="required" name="maximum_amount" id="maximum_amount" value="{{ isset($productUploads->maxmum_amount) ? $productUploads->maxmum_amount : old('maximum_amount') }}">
            </div>

            <div class="form-group col-md-8">
                <label>Turn around time</label>
                <input class="form-control" type="text" required="required" name="turn_time" id="turn_time" value="{{ isset($productUploads->turn_around_time) ? $productUploads->turn_around_time : old('turn_time') }}">
            </div>

            <div class="form-group col-md-8">
                <label>Facility Fee</label>
                <input class="form-control" type="text" required="required" name="facility_fee" id="facility_fee" value="{{ isset($productUploads->facility_rate) ? $productUploads->facility_rate : old('facility_fee') }}">
            </div>

            <div class="form-group col-md-8">
                <label>Insurance Fee</label>
                <input class="form-control" type="text" required="required" name="insurance_rate" id="insurance_rate" value="{{ isset($productUploads->insurance_rate) ? $productUploads->insurance_rate : old('insurance_rate') }}">
            </div>

            <div class="form-group col-md-8">
                <label>Loan Purchase</label>
                <input type="text" name="loanpurchase" id="loanpurchase" required="required" class="form-control"  value="{{ isset($productUploads->loan_purchase) ? $productUploads->loan_purchase : old('loanpurchase') }}">
            </div>

            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary" style="border-radius: 90px;color:#2B3483">
                    <strong style="color:white;">Edit Upload</strong>
                </button>
            </div>
    </form>

</div>
</div>
</section>
</div>
</div>
</div>
</div>
</div>
</section>

<script>
    function FormatCurrency(ctrl) {
    //   Check if arrow keys are pressed - we want to allow navigation around textbox using arrow keys
      if (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40) {
          return;
      }

      var val = ctrl.value;

      val = val.replace(/,/g, "")
      ctrl.value = "";
      val += '';
      x = val.split('.');
      x1 = x[0];
      x2 = x.length > 1 ? '.' + x[1] : '';

      var rgx = /(\d+)(\d{3})/;

      while (rgx.test(x1)) {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
      }

      ctrl.value = x1 + x2;
  }

  function CheckNumeric() {
      return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;
  }
</script>
@endsection
