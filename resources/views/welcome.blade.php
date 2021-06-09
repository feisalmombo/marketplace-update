
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MarketPlace | @lang('home.home_page')</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('temp/images/favicon.png')}}">
    <!-- Favicon icon -->

    <!-- Web Fonts -->
    <link rel="stylesheet" href="{{ asset('temp/extension/fonts/roboto.css') }}">
    <link rel="stylesheet" href="{{ asset('temp/extension/fonts/nunito.css') }}">
    <!-- //web fonts -->

    <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('temp/assets/css/style-starter.css') }}">

  <script src="{{asset('temp/extension/font-awesome/js/all.js')}}"></script>

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

  <script src="{{asset('temp/extension/jquery/jquery.min.js')}}"></script>

   <!-- Global site tag (gtag.js) - Google Analytics -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123142980-3"></script>
   <script>
     window.dataLayer = window.dataLayer || [];
     function gtag(){dataLayer.push(arguments);}
     gtag('js', new Date());

     gtag('config', 'UA-123142980-3');
   </script>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-8FS4V813D7"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-8FS4V813D7');
  </script>

   <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-id").modal('hide');
    });
   </script>
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
          <a href="{{ url('/compare/search/loan') }}" class="compare mr-4">@lang('home.now')</a>
        </div>

        <div class="form-inline">
          <ul class="navbar-nav mr-auto">
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false" style="color: #4C4D62;">
                  @lang('home.choose_language')
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item hide-modal" href="locale/sw" data-dismiss="modal"><img src="{{ asset('temp/images/tanzania.png') }}" alt="Tanzania Flag"> Swahili</a>
                  <a class="dropdown-item" href="locale/en"><img src="{{ asset('temp/images/english.png') }}" alt="English Flag"> English</a>
              </div>
          </li>
          </ul>
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

<div class="modal fade" id="modal-id">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-body">
              <h5 class="modal-title">@lang('home.choose_language')</h5>
              <br>
                  <a class="dropdown-item" href="locale/sw"><img src="{{ asset('temp/images/tanzania.png') }}" alt="Tanzania Flag"> Swahili</a>
                  <a class="dropdown-item" href="locale/en"><img src="{{ asset('temp/images/english.png') }}" alt="English Flag"> English</a>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

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
              <strong>Success</strong>
              <p>
                {{ session('msg1') }}
              </p>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="w3l-index-block1">
  <div class="content">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5 content-left pt-md-0 pt-5">
          <h1>@lang('home.financial_desicions')</h1>
          <p class="mt-3 mb-md-5 mb-4">@lang('home.compare_loans_from_multiple')</p>
          <a class="btn btn-warning" href="{{ url('/compare/search/loan') }}" style="color: white">@lang('home.compare_now')</a>
        </div>

        <div class="col-md-7 content-photo mt-md-0 mt-5">
        <img src="{{asset('temp/assets/images/main.jpg')}}" class="img-fluid" alt="main image">
        </div>
      </div>
      <div class="clear"></div>

    </div>
  </div>
</div>

<!-- Choose Product -->
<section class="w3l-index-block2 py-5">
    <div class="container py-md-3">
        <div class="heading text-center mx-auto">
            <h3 class="head">@lang('home.ourprocess')</h3>
            <p class="my-3 head">@lang('home.this_process_found_in')</p>
        </div>
      <div class="row bottom_grids pt-md-3">
        <div class="col-lg-3 col-md-6 mt-5">
          <div class="s-block">
            <a href="#blog-single.html" class="d-block p-lg-4 p-3" style="pointer-events: none;">
            <img src="{{asset('temp/assets/images/s1.png')}}" alt="" class="img-fluid" />
              <h6 class="my-3" style="color:black;">@lang('home.choose_product')</h6>
              <p class="">@lang('home.get_decision_minutes')</p>
            </a>
          </div>
        </div>


        <div class="col-lg-3 col-md-6 mt-5">
          <div class="s-block">
            <a href="#blog-single.html" class="d-block p-lg-4 p-3" style="pointer-events: none;">
              <img src="{{asset('temp/assets/images/s2.png')}}" alt="" class="img-fluid" />
              <h6 class="my-3" style="color:black;">@lang('home.compare_products')</h6>
              <p class="">@lang('home.compare_competitive_loan_rates')</p>
            </a>
          </div>
        </div>


        <div class="col-lg-3 col-md-6 mt-5">
          <div class="s-block">
            <a href="#blog-single.html" class="d-block p-lg-4 p-3" style="pointer-events: none;">
            <img src="{{asset('temp/assets/images/s3.png')}}" alt="" class="img-fluid" />
            <h6 class="my-3" style="color:black;">@lang('home.make_request')</h6>
            <p class="">@lang('home.easily_apply')</p>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 mt-5">
            <div class="s-block">
              <a href="#blog-single.html" class="d-block p-lg-4 p-3" style="pointer-events: none;">
                <img src="{{asset('temp/assets/images/s2.png')}}" alt="" class="img-fluid" />
                <h6 class="my-3" style="color:black;">@lang('home.track_application')</h6>
                <p class="">@lang('home.conveniently_track')</p>
              </a>
            </div>
          </div>
      </div>
    </div>
</section>
<!-- Product Loan Type -->

<!-- Get Started -->
<section>
    <div class="container">
        <div class="row">
            <div class="form-group col-lg-12 p-4" style="text-align:center;">
                <div class="get-started">
                    <a href="{{ url('/compare/search/loan') }}" class="btn btn-warning" style="border-radius: 100px;"><strong style="color:white;">@lang('home.compare_now')</strong></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Get Started -->

<!-- Product Loan Type -->
 <div class="w3l-index-block4">
   <div class="features-bg py-5">
     <div class="container py-md-3">
       <div class="row">
         <div class="col-md-6 features15-col-text">
           <a href="#url" class="d-flex flex-wrap feature-unit align-items-center" style="pointer-events: none;">
             <div class="col-sm-3">
               <div class="features15-info">
                 <span class="fa fa-user" aria-hidden="true"></span>
               </div>
             </div>
             <div class="col-sm-9 mt-sm-0 mt-4">
               <div class="features15-para">
                <h4>@lang('home.personal_loans')</h4>
                 <p>@lang('home.access_personal_finance')</p>
               </div>
             </div>
           </a>
         </div>
         <div class="col-md-6 features15-col-text">
           <a href="#url" class="d-flex flex-wrap feature-unit align-items-center" style="pointer-events: none;">
             <div class="col-sm-3">
               <div class="features15-info">
                 <span class="fa fa-briefcase" aria-hidden="true"></span>
               </div>
             </div>
             <div class="col-sm-9 mt-sm-0 mt-4">
               <div class="features15-para">
                <h4>@lang('home.business_loans')</h4>
                <p>@lang('home.listed_range_business')</p>
               </div>
             </div>
           </a>
         </div>
         <div class="col-md-6 features15-col-text">
           <a href="#url" class="d-flex flex-wrap feature-unit align-items-center" style="pointer-events: none;">
             <div class="col-sm-3">
               <div class="features15-info">
                 <span class="fa fa-home" aria-hidden="true"></span>
               </div>
             </div>
             <div class="col-sm-9 mt-sm-0 mt-4">
               <div class="features15-para">
                <h4>@lang('home.home_loans')</h4>
                <p>@lang('home.home_financing_options')</p>
               </div>
             </div>
           </a>
         </div>
         <div class="col-md-6 features15-col-text">
           <a href="#url" class="d-flex flex-wrap feature-unit align-items-center" style="pointer-events: none;">
             <div class="col-sm-3">
               <div class="features15-info">
                 <span class="fa fa-car" aria-hidden="true"></span>
               </div>
             </div>
             <div class="col-sm-9 mt-sm-0 mt-4">
               <div class="features15-para">
                <h4>@lang('home.motorvehicle_loans')</h4>
                <p>@lang('home.readable_content')</p>
               </div>
             </div>
           </a>
         </div>
       </div>
       <div>
       </div>
     </div>
   </div>
 </div>
 <!-- Product Loan Type -->


<!-- About GetPesa -->
<section class="w3l-index-block7 py-5">
  <div class="container py-md-3">
    <div class="row cwp17-two align-items-center">
      <div class="col-md-6 cwp17-text">
        <h3>@lang('home.about_marketplace') MarketPlace</h3>
        <p>@lang('home.our_platform_automated')</p>
      </div>
      <div class="col-md-6" style="float:right;">
      <img src="{{asset('temp/assets/images/mobile-app.png')}}" class="img-fluid" alt="" />
      </div>
    </div>
  </div>
</section>
<!-- About GetPesa -->

<!-- Subscribe -->
@include('partials.subscribe')
<!-- Subscribe -->

      <!-- Footer -->
      <section class="w3l-market-footer">
        <footer class="footer-28">
          <div class="footer-bg-layer">
            <div class="container py-lg-3">
              <div class="row footer-top-28">
                <div class="col-md-6 footer-list-28 mt-5">
                  <h1 class="footer-title-28"><strong style="color: #2B3483;">MarketPlace</strong><strong style="color: #E58225;">.</strong></h1>
                </div>

              </div>
            </div>


            <div class="midd-footer-28 align-center py-lg-4 py-3 mt-5">
              <div class="container">
                <p class="copy-footer-28 text-center"> &copy; {{  date('Y') }} MarketPlace<strong style="color: yellow;">.</strong>@lang('home.all_rights_reserved') <a
                    href="https://getpesa.co.tz/" target="_blank">GetPesa</a></p>
              </div>
            </div>
          </div>
        </footer>

        <!-- move top -->
        <button onclick="topFunction()" id="movetop" title="@lang('home.go_to_top')">
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

        <script type = "text/javascript">
            function getValue() {
               var retVal = prompt("Enter Language : ", "your name here");
               document.write("You have entered : " + retVal);
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
