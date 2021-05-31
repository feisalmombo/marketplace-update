<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>MarketPlace | @lang('applyrequest.apply_request')</title>

      <!-- Favicon icon -->
      <link rel="icon" type="image/png" sizes="16x16" href="{{asset('temp/images/favicon.png')}}">
      <!-- Favicon icon -->

      <!-- Web Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i|Montserrat:400,700" rel="stylesheet">
       <link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
       <link href="//fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap" rel="stylesheet">
       <!-- //web fonts -->
      <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('temp/assets/css/style-starter.css') }}">
  <style>
    html {
    margin: 40px auto;
    }
    .btn-search {
        background: #C64343;
        border-radius: 0;
        color: #fff;
        border-width: 1px;
        border: #C64343;
        border-color: #C64343;
        }
	.btn-search:link, .btn-search:visited {
	  color: #C64343;
	}
	.btn-search:active, .btn-search:hover {
	  background: #C64343;
	  color: #C64343;
    }

    .panel {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    }
  </style>
  </head>
  <body>
<div class="w3l-bootstrap-header fixed-top">
  <nav class="navbar navbar-expand-lg navbar-light p-2">
    <div class="container">
    <a class="navbar-brand" href="{{url('/')}}"><strong style="color:#2B3483">MarketPlace</strong><strong style="color:#E58225">.</strong></a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
        </ul>
        <div class="form-inline">
          <a href="#" class="help mr-4">@lang('home.our_process')</a>
        </div>

        <div class="form-inline">
          <a href="#" class="about mr-4">@lang('home.loan_products')</a>
        </div>

        <div class="form-inline">
        <a href="#" class="faq mr-4">@lang('home.faqs')</a>
        </div>

        <div class="form-inline">
          <a href="{{ route('login') }}" class="btn btn-warning sign" style="border-radius: 90px;"><strong style="color:white;">@lang('home.sign_in')</strong></a>
        </div>

      </div>
    </div>
  </nav>
</div>
<br>
<br>

<!-- index -->
<div class="w3l-index-block1">
  <div class="content">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5 content-left pt-md-0 pt-5">
          <h1>@lang('applyrequest.apply_for_your_comparison')</h1>
          <p class="mt-3 mb-md-5 mb-4">@lang('applyrequest.applynow')</p>
        </div>
        <div class="col-md-7 content-photo mt-md-0 mt-5">
        <img src="{{asset('temp/assets/images/main.jpg')}}" class="img-fluid" alt="main image">
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!-- index -->
<br>
<br>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
              <ul>
                @foreach ($errors->all() as $error)
                <li>
                  {{ $error }}
                </li>
                @endforeach
              </ul>
            </div>
            @endif
            @if (Session::has('msg'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ session('msg') }}</strong>
            </div>
            @endif
            @if (Session::has('msg1'))
            <div class="alert alert-success" role="alert">
              <p>
                {{ session('msg1') }}
              </p>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="container">
    <div class="col-lg-12">
        <div class="panel-body">
            <div class="container">
                <div class="col-xl-12">
                <form role="form"  action="{{ url('/apply/request') }}" method="POST">
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">

                @if(session()->has('msg1'))
                    <div class="input-group">
                        <div class="form-group col-md-8">
                            <label for="otp"><strong>Enter OTP to verify your phone number</strong></label>
                            <input type="text" id='otp' name="otp" required="required" class="form-control" placeholder="e.g: 890732">
                        </div>
                    </div>
                @endif

                    <br>
                    <div class="input-group">
                        <div class="form-group col-md-8">
                            <h4>@lang('applyrequest.personal_information')</h4>
                            <p>@lang('applyrequest.information_about_you')</p>
                        </div>
                    </div>
                        <div class="input-group">
                            <div class="form-group col-md-4">
                                <label for="full_name">@lang('applyrequest.full_name')</label>
                                <input type="text" id='full_name' name="full_name" required="required" class="form-control" value="{{ old('full_name') }}" placeholder="@lang('applyrequest.e_g'): Feisal Mombo">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="email">@lang('applyrequest.email')</label>
                                <input type="email" id='email' name="email" required="required" class="form-control" value="{{ old('email') }}"  placeholder="@lang('applyrequest.e_g'): feisal.mombo@getpesa.co.tz">
                            </div>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="form-group col-md-4">
                                <label for="phone_number">@lang('applyrequest.phone_number')</label>
                                <input type="tel" id='phone_number' name="phone_number" required="required" class="form-control" value="{{ old('phone_number') }}" placeholder="@lang('applyrequest.e_g'): 0684456287">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="dob">@lang('applyrequest.date_of_birth')</label>
                                <input type="date" id='dob' name="dob" required="required" class="form-control" value="{{ old('dob') }}">
                            </div>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="form-group col-md-4">
                                <label for="id_number">@lang('applyrequest.id_number')</label>
                                <input type="text" id='id_number' name="id_number" required="required" class="form-control" value="{{ old('id_number') }}" placeholder="@lang('applyrequest.e_g'): 198932809412080000528">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="city">@lang('applyrequest.city')</label>
                                <select class="form-control" required="required" name="cityID" id="cityID">
                                    <option value="">-- @lang('applyrequest.select_city') --</option>
                                    @foreach($cities as $city)
                                    <option value="{{ $city->id}}" {{ $city->id == old('cityID') ? 'selected' : ''}}>{{ $city->city_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="form-group col-md-4">
                                <label for="password">@lang('applyrequest.password')</label>
                                <input type="password" id='password' name="password" value="{{ old('password') }}" placeholder="e.g: ******" required class="form-control">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="password_confirmation">@lang('applyrequest.confirm_password')</label>
                                <input type="password" id='password_confirmation' name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="e.g: ******" required class="form-control">
                            </div>
                        </div>
                        <br>

                        <div class="input-group">
                            <div class="form-group col-md-8">
                                <h4>@lang('applyrequest.employment_information')</h4>
                                <p>@lang('applyrequest.relevant_employment_information')</p>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="form-group col-md-8">
                                <label for="workplace">@lang('applyrequest.workplace')</label>
                                <input type="text" id='workplace' name="workplace" required="required" class="form-control" value="{{ old('workplace') }}" placeholder="@lang('applyrequest.e_g'): Google Africa PLC">
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="form-group col-md-8">
                                <p><strong style="color:black">@lang('applyrequest.employers_details'):</strong></p>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="form-group col-md-4">
                                <label for="address">@lang('applyrequest.address')</label>
                                <input type="text" id='address' name="address" required="required" class="form-control" value="{{ old('address') }}" placeholder="@lang('applyrequest.e_g'): 15th Down Street, Parklands, Arusha">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="employernumber">@lang('applyrequest.phone_number')</label>
                                <input type="tel" id='employernumber' name="employernumber" required="required" class="form-control" value="{{ old('employernumber') }}" placeholder="@lang('applyrequest.e_g'): 0784908732">
                            </div>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="form-group col-md-4">
                                <label for="netsalary">@lang('applyrequest.net_salary') (@lang('applyrequest.monthly'))</label>
                                <input type="text" id='netsalary' name="netsalary" required="required" class="form-control" value="{{ old('netsalary') }}" placeholder="@lang('applyrequest.e_g'): 3,000,000" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="jobtitle">@lang('applyrequest.job_title')</label>
                                <input type="text" id='jobtitle' name="jobtitle" required="required" class="form-control" value="{{ old('jobtitle') }}" placeholder="@lang('applyrequest.e_g'): Software Developer">
                            </div>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="form-group col-md-8">
                                <label><strong style="color:black;">@lang('applyrequest.other_loans')</strong></label>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <select class="form-control" id="status" required="required" name="status">
                                <option value="">-- @lang('applyrequest.select_option') --</option>
                                <option value="no" @if (old('status') == "no") {{ 'selected' }} @endif>No</option>
                                <option value="yes" @if (old('status') == "yes") {{ 'selected' }} @endif>Yes</option>
                            </select>
                        </div>

                        <div class="form-group" id="otherFieldGroupDiv">
                            <div class="col-6">
                                <label for="bank_name">@lang('applyrequest.if_yes')</label>
                                <input type="text" class="form-control w-100" id="bank_name" name="bank_name" required="required" value="{{ old('bank_name') }}" placeholder="@lang('applyrequest.e_g'): CRDB">
                            </div>
                        </div>
                        <br>
                        @foreach($documentsDatas as $key => $documentsData)

                        @endforeach
                        <div class="input-group">
                            <div class="form-group col-md-4">
                                <input type="checkbox" name="terms" id="terms" value="on"  {{ old('terms') == 'on' ? 'checked' : '' }} required="required" style="color: black;" /> <a href="{{ Storage::url($documentsData->file_path) }}" target="_blank"><u>@lang('applyrequest.by_clicking_on_Apply')</u></a>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="form-group col-md-4">
                                <button type="submit" class="btn btn-primary">@lang('applyrequest.apply')</button>
                            </div>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<section class="w3l-market-footer">
    <footer class="footer-28">
        <div class="footer-bg-layer">
          <div class="container py-lg-3">
            <div class="row footer-top-28">
              <div class="col-md-6 footer-list-28 mt-5">
                <h1 class="footer-title-28"><strong style="color: #2B3483;">MarketPlace</strong><strong style="color: #E58225;">.</strong></h1>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6 footer-list-28 mt-5">
                    <h6 class="footer-title-28">@lang('home.quick_links')</h6>
                    <ul>
                      <li><a href="#">@lang('home.about_us')</a></li>
                      <li><a href="#">@lang('home.bl_og')</a></li>
                      <li><a href="#">@lang('home.cont_act')</a></li>
                      <li><a href="#">@lang('home.faqs')</a></li>
                    </ul>
                  </div>

                  <div class="col-md-6 footer-list-28 mt-5">
                    <h6 class="footer-title-28">@lang('home.legal_stuff')</h6>
                    <ul>
                      <li><a href="#">@lang('home.dis_claimer')</a></li>
                      <li><a href="#">@lang('home.fina_ncing')</a></li>
                      <li><a href="#">@lang('home.privacy_policy')</a></li>
                    </ul>
                  </div>

                </div>
              </div>
            </div>
          </div>


          <div class="midd-footer-28 align-center py-lg-4 py-3 mt-5">
            <div class="container">
              <p class="copy-footer-28 text-center"> &copy; 2020 MarketPlace<strong style="color: yellow;">.</strong>@lang('home.all_rights_reserved') <a
                  href="https://getpesa.co.tz/" target="_blank">GetPesa</a></p>
            </div>
          </div>
        </div>
      </footer>

<!-- move top -->
<button onclick="topFunction()" id="movetop" title="Go to top">
    &#10548;
</button>

<script>
    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
    scrollFunction()
    };

    function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("movetop").style.display = "block";
    } else {
        document.getElementById("movetop").style.display = "none";
    }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    }
</script>
<!-- /move top -->
</section>
<!-- Footer -->

<!-- jQuery, Bootstrap JS -->
<script src="{{asset('temp/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('temp/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('temp/assets/js/otherloans.js')}}"></script>

<script>
    function FormatCurrency(ctrl) {
             //Check if arrow keys are pressed - we want to allow navigation around textbox using arrow keys
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
</body>
</html>
