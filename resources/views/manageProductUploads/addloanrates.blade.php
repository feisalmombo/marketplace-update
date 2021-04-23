@extends('layouts.app')

@section('title', 'Add Product Uploads')

@section('content')
<div class="col-lg-12">
<h1 class="page-header">Add Product Uploads</h1>
</div>

<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
Create Product Uploads <a href="{{ url('/product/uploads') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
</div>
<div class="panel-body">
<div class="container-fluid pull-left">
<section class="container center-block">
<div class="container-page">
<div class="col-md-10">
    <form role="form"  action="{{ url('/product/uploads') }}" method="POST">

            {{ csrf_field() }}

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Institution Name</label>
                    <select name="product_id" id="product_id" required="required"  class="form-control">
                        <option selected="selected">--- Select Institution Name ---</option>
                        @foreach($productType as $productTypes)
                        <option value="{{ $productTypes->institution_name }}">{{ $productTypes->institution_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-md-8">
                <label>Product Name</label>
                <input type="text" name="product_name" id="product_name" required="required" class="form-control" placeholder="e.g: NMB Salaried Loan">
            </div>

            <div class="form-group col-md-8">
                <label>Product Code</label>
                <input type="text" name="product_code" id="product_code" required="required" class="form-control" placeholder="e.g: NMB001">
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Loan Type</label>
                    <select name="loan_type_id" id="loan_type_id" required="required"  class="form-control">
                        <option selected="selected">--- Select Loan Type ---</option>
                        @foreach($loanType as $loanTypes)
                        <option value="{{ $loanTypes->loan_name }}">{{ $loanTypes->loan_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Duration</label>
                    <select name="duration" id="duration" required="required"  class="form-control">
                        <option selected="selected">--- Select duration ---</option>
                        @foreach($duration as $durations)
                        <option value="{{ $durations->duration_name }}">{{ $durations->duration_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label>Loan Purpose</label>
                    <select name="loanpurpose" id="loanpurpose" required="required"  class="form-control">
                        <option selected="selected">--- Select Loan Purpose ---</option>
                        @foreach($loanpurposes as $loanpurpose)
                        <option value="{{ $loanpurpose->loan_purpose_name }}">{{ $loanpurpose->loan_purpose_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-md-8">
                <label>Interest Rate</label>
                <input type="text" name="interest_rate" id="interest_rate" required="required" class="form-control" placeholder="e.g: 5">
            </div>

            <div class="form-group col-md-8">
                <label>Minimum Net Salary</label>
                <input type="text" name="minimum_salary" id="minimum_salary" required="required" class="form-control" placeholder="e.g: 800,000">
            </div>

            <div class="form-group col-md-8">
                <label>Minimum amount</label>
                <input type="text" name="minimum_amount" id="minimum_amount" required="required" class="form-control" placeholder="e.g: 500,000">
            </div>


            <div class="form-group col-md-8">
                <label>Maximum amount</label>
                <input class="form-control" type="text" required="required" name="maximum_amount" id="maximum_amount" placeholder="eg: 600,000">
            </div>

            <div class="form-group col-md-8">
                <label>Turn around time</label>
                <input class="form-control" type="text" required="required" name="turn_time" id="turn_time" placeholder="eg: 5 days">
            </div>

            <div class="form-group col-md-8">
                <label>Facility Fee</label>
                <input class="form-control" type="text" required="required" name="facility_fee" id="facility_fee" placeholder="eg: 2.5">
            </div>

            <div class="form-group col-md-8">
                <label>Insurance Fee</label>
                <input class="form-control" type="text" required="required" name="insurance_rate" id="insurance_rate" placeholder="eg: 0.68">
            </div>

            <div class="form-group col-md-8">
                <label>Eligibility</label>
                <textarea class="form-control" type="text" required="required"  rows="4" name="eligibility" id="eligibility" placeholder="eg: All confirmed employees whose employers signed contract with the Bank."></textarea>
            </div>

            <div class="form-group col-md-8">
                <label>Loan Purchase</label>
                <input class="form-control" type="text" required="required" name="loanpurchase" id="loanpurchase" placeholder="eg: allowed">
            </div>

            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary" style="border-radius: 90px;color:#2B3483">
                    <strong style="color:white;">Product Upload</strong>
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
