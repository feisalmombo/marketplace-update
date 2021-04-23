@extends('layouts.app')

@section('title', 'Edit Institution Upload')

@section('content')
<div class="col-lg-12">
<h1 class="page-header">Edit Institution Upload</h1>
</div>

<div class="row">
<section class="content">
<div class="col-lg-12">
@include('msgs.success')
<div class="panel panel-default">
<div class="panel-heading">
List of Institution Upload <a href="{{ url('/institution/uploads') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
</div>
<div class="panel-body">
<div class="container-fluid pull-left">
<section class="container center-block">
<div class="container-page">
<div class="col-md-10">
    <form role="form"  action="{{ url('institution/uploads/'.$products->id) }}" method="POST" enctype="multipart/form-data">

        {{ csrf_field() }}
        {{ method_field('PATCH') }}

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Institution Name</label>
                    <input type="text" name="institution_name" id="institution_name" required="required" class="form-control" value="{{ isset($products->institution_name) ? $products->institution_name : old('institution_name') }}">
                </div>
                <div class="form-group col-md-4">
                    <label>Institution Type</label>
                    <select name="institution_type_id" id="institution_type_id" required="required"  class="form-control">
                        @foreach($institutionTypes as $institutionType)
                        <option value="{{ $institutionType->institution_type_name }}">{{ $institutionType->institution_type_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Institution Logo</label>
                    <input type="file" name="institution_logo" id="institution_logo" class="form-control">
                </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-4">
                <label>Institution Headquarter Address</label>
                <input type="text" name="institution_street_city" id="institution_street_city" required="required" class="form-control" value="{{ isset($products->institution_street_city) ? $products->institution_street_city : old('institution_street_city') }}">
            </div>

            <div class="form-group col-md-4">
                <label>Institution Contact Email</label>
                <input type="email" name="institution_contact_email" id="institution_contact_email" required="required" class="form-control"  value="{{ isset($products->institution_contact_email) ? $products->institution_contact_email : old('institution_contact_email') }}">
            </div>

            <div class="form-group col-md-4">
                <label>Institution Contact Phone Number</label>
                <input type="tel" name="institution_contact_phone_number" id="institution_contact_phone_number" required="required" class="form-control"  value="{{ isset($products->institution_contact_phone_number) ? $products->institution_contact_phone_number : old('institution_contact_phone_number') }}">
            </div>
            </div>


            <div class="form-group col-md-9">
                <label>Institution Social Media Link</label>
                <input type="text" name="institution_social_media_links" id="institution_social_media_links" required="required" class="form-control"  value="{{ isset($products->institution_social_media_links) ? $products->institution_social_media_links : old('institution_social_media_links') }}">
            </div>

            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary" style="border-radius: 90px;color:#2B3483">
                    <strong style="color:white;">Update Product</strong>
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

@endsection
