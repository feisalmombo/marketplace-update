<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>MarketPlace | @lang('searchatwelcome.compare_loan')</title>

      <!-- Favicon icon -->
      <link rel="icon" type="image/png" sizes="16x16" href="{{asset('temp/images/favicon.png')}}">
      <!-- Favicon icon -->

      <!-- Web Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i|Montserrat:400,700" rel="stylesheet">
       {{-- <link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet"> --}}
       {{-- <link href="//fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap" rel="stylesheet"> --}}
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

    .modal-header {
    text-align: left;
    }

    .move-left {
    width: auto;
    box-shadow: none;
    }

    .move-left2 {
    width: auto;
    box-shadow: none;
    }

    .btn-xl {
    font-size: 1000px;
    border-radius: 10px;
    width:220px;
    }

    .accordion-toggle {
        width: 100%;
    }

    @media all and (max-width:500px){
    table{
        width:100%;
        border: none;
        border-top: none;
        border-bottom: none;
    }

    th{
        display:block;
        margin-bottom:30px;
        border: none;
        border-bottom: none;
        border-top: none;
    }

    td{
        display:block;
        width:100%;
        border: none;
        border-bottom: none;
        border-top: none;
    }

    tr{
        display:block;
        margin-bottom:30px;
        border: none;
        border-bottom: none;
        border-top: none;
    }
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
          <a href="#" class="help mr-4" style="pointer-events: none;">@lang('home.our_process')</a>
        </div>

        <div class="form-inline">
          <a href="#" class="about mr-4" style="pointer-events: none;">@lang('home.loan_products')</a>
        </div>

        <div class="form-inline">
        <a href="#" class="faq mr-4" style="pointer-events: none;">@lang('home.faqs')</a>
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

<!-- index -->
<div class="w3l-index-block1">
  <div class="content">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5 content-left pt-md-0 pt-5">
            <h1>@lang('searchatwelcome.compare_one_products_loans')</h1>
            <p class="mt-3 mb-md-5 mb-4">@lang('searchatwelcome.one_products_loans')</p>
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
            @if (Session::has('msg100'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ session('msg100') }}</strong>
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

<div class="container">
    <div class="col-lg-12">
        <div class="panel-body">
            <div class="container">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <form action="{{ url('/compare/search/loan') }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="input-group">
                                    <div class="form-group btn-min-width mr-1 mb-1 btn-xl">
                                        <select class="form-control"  required="required" name="loantype" style="font-family: Montserrat;">
                                            <option value="e">--@lang('searchatwelcome.select_loan_purpose')--</option>
                                            @foreach($loan_types as $loantype)
                                            <option value="{{ $loantype->id }}">{{ $loantype->loan_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group btn-min-width mr-1 mb-1 btn-xl">
                                        <input type="numeric" id='loan_amount' name="loan_amount" size="4" required="required" class="form-control" placeholder="@lang('searchatwelcome.loan_amount') ( @lang('searchatwelcome.tzs') )"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                                    </div>

                                    <div class="form-group btn-min-width mr-1 mb-1 btn-xl">
                                        <input type="numeric" id='duration' name="duration" size="10" required="required" class="form-control" placeholder="@lang('searchatwelcome.loan_period') (@lang('searchatwelcome.months'))"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                                    </div>

                                    <div class="form-group btn-min-width mr-1 mb-1 btn-xl">
                                        <input type="numeric" id='net_salary' name="net_salary" size="4" required="required" class="form-control" placeholder="@lang('searchatwelcome.net_salary') ( @lang('searchatwelcome.tzs') )"  onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                                    </div>

                                    <span class="form-group btn-min-width mr-1 mb-1">
                                        <button class="btn btn-primary" name="submit" type="submit">@lang('searchatwelcome.search')</button>
                                    </span>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<!-- Results Table -->
<div class="container">
    <div class="col-lg-12">
        <div class="panel-body">
            <div class="container">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="card" style="text-align: center">

                                    <p><strong>@lang('searchatwelcome.comparison_product_summary_table')</strong><p>
                                    @if(Session::has('data'))
                                    @foreach(Session::get('data') as $key=>$compareloan)
                                    <div class="card-body">
                                            <table class="table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>@lang('searchatwelcome.s_n')</th>
                                                        <th>@lang('searchatwelcome.institution_name')</th>
                                                        <th>@lang('searchatwelcome.interest_rate')</th>
                                                        <th>@lang('searchatwelcome.facility_fee')</th>
                                                        <th>@lang('searchatwelcome.monthly_payment')</th>
                                                        <th>@lang('searchatwelcome.insurance_fee')</th>
                                                        <th>@lang('searchatwelcome.tenure')</th>
                                                        <th>@lang('searchatwelcome.debt_burden_ratio')</th>
                                                        <th>@lang('searchatwelcome.net_amount')</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $compareloan['institution_name'] }}
                                                        </td>
                                                        <td>{{ number_format($compareloan['interest_rate']) }}%</td>
                                                        <td>{{ number_format($compareloan['facilite_fee']) }}</td>
                                                        <td>{{ number_format($compareloan['repayment']) }}</td>
                                                        <td>{{ number_format($compareloan['insurance_fee']) }}</td>
                                                        <td>{{ number_format($compareloan['duration']) }}</td>
                                                        <td>
                                                            @if($compareloan['dir'] >=56)
                                                                <span style="color: red">{{ $compareloan['dir']}}%</span>
                                                                @elseif($compareloan['dir'] >=41 && $compareloan['dir'] <=55)
                                                                <span style="color: orange">{{ $compareloan['dir']}}%</span>
                                                                @elseif($compareloan['dir'] <=40)
                                                                <span style="color: green">{{ $compareloan['dir']}}%</span>
                                                                @else
                                                                <span>{{ $compareloan['dir']}}%</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ number_format($compareloan['net_amount']) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <div id="accordion">
                                                    <h5 class="mb-0">
                                                      <button class="btn btn-link" style="color: red; float: left" data-toggle="collapse" data-target="#collapseOne{{$compareloan['id']}}" aria-expanded="true" aria-controls="collapseOne">
                                                        @lang('searchatwelcome.explore_details')
                                                      </button>
                                                        <a href="{{url('/apply/request/'.$compareloan['id'])}}" style="float: right"><strong style="color:#C64343;font-size:16px">@lang('searchatwelcome.apply')</strong></a>
                                                    </h5>
                                                    <br>
                                                    <br>
                                                  <div id="collapseOne{{$compareloan['id']}}" class="collapse hidden" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="container">
                                                    <div class="row" style="float: left">
                                                        <div class="col-sm-5 col-md-6">
                                                                <strong>@lang('searchatwelcome.fees_and_charges')</strong>
                                                                <p>. @lang('searchatwelcome.loan_processing_fee'): {{ number_format($compareloan['institution_facility_rate']) }}%</p><br>
                                                                <p>. @lang('searchatwelcome.prepayment_charge'): {{ number_format($compareloan['repayment']) }} </p><br>
                                                                <p>. @lang('searchatwelcome.insurance_fee'): {{ number_format($compareloan['insurance_fee']) }}</p>
                                                        </div>

                                                        <div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">
                                                            <strong>@lang('searchatwelcome.documents_required')</strong>
                                                            <p>. @lang('searchatwelcome.id_proof_and_address')</p><br>
                                                            <p>. @lang('searchatwelcome.six_months_bank_statement')</p><br>
                                                            <p>. @lang('searchatwelcome.tax_certificate')</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                  </div>
                                            </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="alert alert-info">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong>@lang('searchatwelcome.no_comparison_for_loan_found')</strong>
                                    </div>
                                    @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="col-lg-12">
        <div class="panel-body">
            <div class="container">
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body" align="center">
                            <h5 class="card-title"><strong style="color:black;">@lang('searchatwelcome.help')</strong></h5>
                            <p class="card-text py-md-3">@lang('searchatwelcome.for_futher_information_the_administration')</p>

                            <button class="btn btn-warning sign" data-toggle="modal" data-target="#myModalNorm1" style="border-radius: 90px;">
                                <strong style="color:white;">@lang('searchatwelcome.call_me')</strong>
                            </button>

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
                                        @if (Session::has('msgCallMe'))
                                        <div class="alert alert-success" role="alert">
                                          <strong>Success</strong>
                                          <p>
                                            {{ session('msgCallMe') }}
                                          </p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                             <!-- Modal -->
                            <div class="modal fade" id="myModalNorm1" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                        <div class="modal-header">
                                                <button type="button" class="close"
                                                data-dismiss="modal">
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel1">
                                                <strong>@lang('searchatwelcome.call_me_back_request'):</strong>
                                                <p>@lang('searchatwelcome.please_fill_in_your_details')</p>
                                            </h4>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">

                                        <form role="form" action="{{ url('/call-me/request') }}" method="POST">

                                            {{ csrf_field() }}

                                            <div class="input-group">
                                                <div class="form-group col-md-12">
                                                    <label for="fullname" style="text-align:left">@lang('searchatwelcome.Na_me')</label>
                                                    <input type="text" id='fullname' name="fullname" required="required" class="form-control" placeholder="@lang('searchatwelcome.e_g'): Hassan Kisengeni">
                                                </div>
                                            </div>
                                            <br>

                                            <div class="input-group">
                                                <div class="form-group col-md-6">
                                                    <label for="pnumber">@lang('searchatwelcome.phone_number')</label>
                                                    <input type="tel" id='pnumber' name="pnumber" required="required" class="form-control" placeholder="@lang('searchatwelcome.e_g'): 255788900979">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="emailaddress">@lang('searchatwelcome.email_address')</label>
                                                    <input type="email" id='emailaddress' name="emailaddress" required="required" class="form-control" placeholder="@lang('searchatwelcome.e_g'): mlinga.kasimu@yahoo.com">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="input-group">
                                                <div class="form-group col-md-8 move-left2">
                                                    <input type="checkbox" name="conditionsterms" id="conditionsterms" required="required" style="color: black;" /> @lang('searchatwelcome.by_clicking_on_call_me')
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-warning sign" style="border-radius: 90px;"><strong style="color:white;">@lang('searchatwelcome.call_me')</strong></button>
                                            </div>
                                        </form>
                                        </div>

                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                            data-dismiss="modal">
                                            @lang('searchatwelcome.close')
                                        </button>
                                        </div>
                            </div>
                            </div>
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
<br>

{{--  Download Report Here  --}}
<div class="container">
    <div class="col-lg-12">
        <div class="panel-body">
            <div class="container">
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body" align="center">
                            <h5 class="card-title"><strong style="color:black;">@lang('searchatwelcome.download_report')</strong></h5>
                            <p class="card-text py-md-3">@lang('searchatwelcome.download_this_summary_reports')</p>

                            <button class="btn btn-warning sign" data-toggle="modal" data-target="#myModalNorm" style="border-radius: 90px;">
                                <strong style="color:white;">@lang('searchatwelcome.download_report')</strong>
                            </button>

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
                                        @if (Session::has('msg12'))
                                        <div class="alert alert-success" role="alert">
                                          <strong>Success</strong>
                                          <p>
                                            {{ session('msg12') }}
                                          </p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                             <!-- Modal -->
                            <div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                        <div class="modal-header">
                                                <button type="button" class="close"
                                                data-dismiss="modal">
                                            </button>
                                            <h4 class="modal-title" id="myModalLabel">
                                                <form action="{{url('/compare/search/loan/report/pdf/downloadPdf')}}" method="POST">
                                                    {{ csrf_field() }}
							                                      <input type="text" hidden="hidden" value="{{ json_encode(Session::get('data')) }}" name="tad">
                                                </form>
                                                <p>@lang('searchatwelcome.please_fill_in_your_contact')</p>
                                            </h4>
                                        </div>

                                        <!-- Modal Body -->
                                        <div class="modal-body">

                                        <form role="form" action="{{ url('/download/report') }}" method="POST">

                                            {{ csrf_field() }}
							                              <input type="text" hidden="hidden" value="{{ json_encode(Session::get('data')) }}" name="tad">

                                            <div class="input-group">
                                                <div class="form-group col-md-12">
                                                    <label for="name" style="text-align:left">@lang('searchatwelcome.Na_me')</label>
                                                    <input type="text" id='name' name="name" required="required" class="form-control" placeholder="@lang('searchatwelcome.e_g'): Katambala Anthony">
                                                </div>
                                            </div>
                                            <br>

                                            <div class="input-group">
                                                <div class="form-group col-md-6">
                                                    <label for="phonenumber">@lang('searchatwelcome.phone_number')</label>
                                                    <input type="tel" id='phonenumber' name="phonenumber" required="required" class="form-control" placeholder="@lang('searchatwelcome.e_g'): 255788902346">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="email">@lang('searchatwelcome.email_address')</label>
                                                    <input type="email" id='email' name="email" required="required" class="form-control" placeholder="@lang('searchatwelcome.e_g'): katambala09@gmail.com">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="input-group">
                                                <div class="form-group col-md-8 move-left">
                                                    <input type="checkbox" name="terms" id="terms" required="required" style="color: black;" /> @lang('searchatwelcome.by_clicking_on_call_me')
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-warning sign" style="border-radius: 90px;"><strong style="color:white;">@lang('searchatwelcome.sub_mit')</strong></button>
                                            </div>
                                        </form>
                                        </div>

                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                            data-dismiss="modal">
                                            @lang('searchatwelcome.close')
                                        </button>
                                        </div>
                            </div>
                            </div>
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
                    <h6 class="footer-title-28">@lang('home.quick_links')</h6>
                    <ul>
                      <li><a href="#" style="pointer-events: none;">@lang('home.about_us')</a></li>
                      <li><a href="#" style="pointer-events: none;">@lang('home.bl_og')</a></li>
                      <li><a href="#" style="pointer-events: none;">@lang('home.cont_act')</a></li>
                      <li><a href="#" style="pointer-events: none;">@lang('home.faqs')</a></li>
                    </ul>
                  </div>

                  <div class="col-md-6 footer-list-28 mt-5">
                    <h6 class="footer-title-28">@lang('home.legal_stuff')</h6>
                    <ul>
                      <li><a href="#" style="pointer-events: none;">@lang('home.dis_claimer')</a></li>
                      <li><a href="#" style="pointer-events: none;">@lang('home.fina_ncing')</a></li>
                      <li><a href="#" style="pointer-events: none;">@lang('home.privacy_policy')</a></li>
                    </ul>
                  </div>

                </div>
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
<!-- /move top -->
</section>
<!-- Footer -->

<!-- jQuery, Bootstrap JS -->
<script src="{{asset('temp/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('temp/assets/js/bootstrap.min.js')}}"></script>

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


<script type="text/javascript">
    .collapse('hide')
</script>

<script>
    function removeElement() {
      document.getElementById("imgbox1").style.display = "none";
    }

    function changeVisibility() {
      document.getElementById("imgbox2").style.visibility = "hidden";
    }

    function resetElement() {
      document.getElementById("imgbox1").style.display = "block";
      document.getElementById("imgbox2").style.visibility = "visible";
    }
</script>

</body>
</html>
