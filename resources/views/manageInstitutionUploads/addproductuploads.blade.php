@extends('layouts.app')

@section('title', 'Institution Upload')

@section('content')
<div class="col-lg-12">
<h1 class="page-header">Institution Upload</h1>
</div>

<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
Create Institution Upload <a href="{{ url('/institution/uploads') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
</div>
<div class="panel-body">
<div class="container-fluid pull-left">
<section class="container center-block">
<div class="container-page">
<div class="col-md-10">
    <form role="form"  action="{{ url('/institution/uploads') }}" method="POST" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Institution Name</label>
                    <input type="text" name="institution_name" id="institution_name" required="required" class="form-control" placeholder="e.g: CRDB">
                </div>
                <div class="form-group col-md-4">
                    <label>Institution Type</label>
                    <select name="institution_type_id" id="institution_type_id" required="required"  class="form-control">
                        <option selected="selected">--- Select Institution Type ---</option>
                        @foreach($institutionTypes as $institutionType)
                        <option value="{{ $institutionType->institution_type_name }}">{{ $institutionType->institution_type_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Institution Logo</label>
                    <input type="file" name="institution_logo" id="institution_logo" required="required" class="form-control" placeholder="Institution Logo">
                </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-4">
                <label>Institution Headquarter Address</label>
                <input type="text" name="institution_street_city" id="institution_street_city" required="required" class="form-control" placeholder="Enter City, Street">
            </div>

            <div class="form-group col-md-4">
                <label>Institution Contact Email</label>
                <input type="email" name="institution_contact_email" id="institution_contact_email" required="required" class="form-control" placeholder="Contact Email">
            </div>

            <div class="form-group col-md-4">
                <label>Institution Contact Phone Number</label>
                <input type="tel" name="institution_contact_phone_number" id="institution_contact_phone_number" required="required" class="form-control" placeholder="Contact Phone Number">
            </div>
            </div>


            <div class="form-group col-md-9">
                <label>Institution Social Media Link</label>
                <input type="text" name="institution_social_media_links" id="institution_social_media_links" class="form-control" placeholder="Social Media Link">
            </div>

            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary" style="border-radius: 90px;color:#2B3483">
                    <strong style="color:white;">Upload Institution</strong>
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
