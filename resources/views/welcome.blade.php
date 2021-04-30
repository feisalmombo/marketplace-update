
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="facebook-domain-verification" content="n3of6x2sbtk9nefmo8x6nw907nm0at" />

    <title>MarketPlace | @lang('home.home_page')</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('temp/images/favicon.png')}}">
    <!-- Favicon icon -->

    <!-- Web Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i|Montserrat:400,700" rel="stylesheet"> --}}
    <link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap" rel="stylesheet">
    <!-- //web fonts -->

    <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('temp/assets/css/style-starter.css') }}">

  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
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

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

   <!-- Global site tag (gtag.js) - Google Analytics -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123142980-3"></script>
   <script>
     window.dataLayer = window.dataLayer || [];
     function gtag(){dataLayer.push(arguments);}
     gtag('js', new Date());

     gtag('config', 'UA-123142980-3');
   </script>

   <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1415608895438553');
    fbq('track', 'PageView');
    </script>
    <noscript>
    <img height="1" width="1"
    src="https://www.facebook.com/tr?id=1415608895438553&ev=PageView
    &noscript=1"/>
    </noscript>
<!-- End Facebook Pixel Code -->

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
        // $("#modal-id").modal('show');
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
          <a href="#" style="pointer-events: none;" class="help mr-4">@lang('home.our_process')</a>
        </div>

        <div class="form-inline">
          <a href="#" style="pointer-events: none;" class="about mr-4">@lang('home.loan_products')</a>
        </div>

        <div class="form-inline">
        <a href="#" style="pointer-events: none;" class="faq mr-4">@lang('home.faqs')</a>
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



<!-- FAQS -->
<div class="w3l-index-block4">
  <div class="features-bg py-5">
    <!-- features15 block -->
    <div class="container py-md-3">
      <div class="heading text-center mx-auto">
        <h3 class="head">@lang('home.frequently_asked_questions')</h3>
        <p class="my-3 head">@lang('home.find_quick_answers')</p>
      </div>
      <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="s-block">
                <h6 class="my-3" style="color: #2B3483">@lang('home.gen_eral')</h6>
                <p class=""><a href="" style="pointer-events: none;" style="color: black">@lang('home.how_make_loan')</a></p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
              <div class="s-block">
                  <h6 class="my-3" style="color: #2B3483">@lang('home.app_lication')</h6>
                  <p class=""><a href="" style="pointer-events: none;" style="color: black">@lang('home.what_are_the_procedure')</a></p>
              </div>
          </div>

          <div class="col-lg-4 col-md-6">
              <div class="s-block">
                  <h6 class="my-3" style="color: #2B3483">@lang('home.track_information')</h6>
                  <p class=""><a href="" style="pointer-events: none;" style="color: black">@lang('home.all_information_appear')</a></p>
              </div>
          </div>
      </div>
    </div>


  </div>
</div>
<!-- FAQS -->

<!-- Subscribe -->
@include('partials.subscribe')
<!-- Subscribe -->

      <!-- Footer -->
        @include('partials.anotherfooter')
      <!-- Footer -->

      <!-- jQuery, Bootstrap JS -->
    <script src="{{asset('temp/assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('temp/assets/js/bootstrap.min.js')}}"></script>

</body>
</html>
