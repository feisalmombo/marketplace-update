<!DOCTYPE html>
<html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>Explore Details </title>

      <!-- Favicon icon -->
      <link rel="icon" type="image/png" sizes="16x16" href="{{asset('temp/images/favicon.png')}}">
      <!-- Favicon icon -->

      <!-- Web Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i|Montserrat:400,700" rel="stylesheet">
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

    .modal-header {
    text-align: left;
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
          <a href="#" class="help mr-4">Our Process</a>
        </div>

        <div class="form-inline">
          <a href="#" class="about mr-4">Loan Products</a>
        </div>

        <div class="form-inline">
        <a href="#" class="faq mr-4">Faq's</a>
        </div>

        <div class="form-inline">
          <a href="{{ route('login') }}" class="btn btn-warning sign" style="border-radius: 90px;"><strong style="color:white;">Sign in</strong></a>
        </div>

        {{-- <div class="form-inline">
            <a href="#" class="btn btn-default" style="float:right; position:absolute;right:9px;border-radius: 90px;"><img src="https://lipis.github.io/flag-icon-css/flags/4x3/us.svg" height="15" alt="USA flag"> English</a>
        </div> --}}

      </div>
    </div>
  </nav>
</div>
<br>
<br>

<!-- index -->
<div class="w3l-index-block1">
  <div class="content py-5">
    <div class="container">
      <div class="row align-items-center py-md-5 py-3">
        <div class="col-md-5 content-left pt-md-0 pt-5">
          <h1>Explore Details</h1>
          <p class="mt-3 mb-md-5 mb-4">At this part you can see the summary in details in order to help you to get more information on how to apply and what are the important information and documents required for people to apply in that applications.</p>
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

<!-- Results Table -->
<div class="container">
    <div class="col-lg-12">
        <div class="panel-body">
            <div class="container">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <label><strong>Fees and Charges</strong></label>
                                    <p>How much do you need to pay and what do you get?</p><br>
                                    <p>. Loan processing fee:2% of loan amount</p><br>
                                    <p>. 10% prepayment charge</p><br>
                                    <p>. 2% insurance fee</p>
                                </div>

                                <div class="col-md-4">
                                    <label><strong>Eligibility Criteria</strong></label>
                                    <p>Do you meet the minimum requirements for this product?</p><br>
                                    <p>. Loan processing fee:2% of loan amount</p><br>
                                    <p>. 10% prepayment charge</p><br>
                                    <p>. 2% insurance fee</p>
                                </div>

                                <div class="col-md-4">
                                    <label><strong>Documents Required</strong></label>
                                    <p>Documents needed to apply for this loan</p><br>
                                    <p>. ID Proof and Current address</p><br>
                                    <p>. 6 Months bank statement</p><br>
                                    <p>. Tax Certificate</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

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
                <h6 class="footer-title-28">Quick Links</h6>
                <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">FAQ</a></li>
                </ul>
            </div>

            <div class="col-md-6 footer-list-28 mt-5">
                <h6 class="footer-title-28">Legal Stuff</h6>
                <ul>
                <li><a href="#">Disclaimer</a></li>
                <li><a href="#">Financing</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>

            </div>
        </div>
        </div>
    </div>


    <div class="midd-footer-28 align-center py-lg-4 py-3 mt-5">
        <div class="container">
        <p class="copy-footer-28 text-center"> &copy; 2020 MarketPlace<strong style="color: yellow;">.</strong> All Rights Reserved. Designed & Developed by <a
            href="https://getpesa.co.tz/" target="_blank">GetPesa PLC </a></p>
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

</body>
</html>
