@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- Main content -->



@if(Auth::user()->hasRole('borrower'))

<section class="content">
  <h1>
      <strong>Tracking Dashboard</strong>
  </h1>
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
  <a href="{{url('/loan/applied')}}">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-address-card"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">1. Apply Request</span>
        <span class="info-box-number">{!!  $borrowerApplyCount !!}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </a>
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
  <a href="{{url('/loan/pending')}}">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-ban"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">2. Pending Request</span>
        <span class="info-box-number">{!!  $borrowerPendingCount !!}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </a>
  </div>
  <!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-12">
  <a href="{{url('borrower/loan/request/banker/approved')}}">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-check-circle"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">3. Approval Request</span>
        <span class="info-box-number">{!!  $borrowerApprovedCount !!}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </a>
  </div>
</div>
</section>
@endif

@if(Auth::user()->hasRole('financial agent'))
<section class="content-header">
      <div class="row">
      <div class="col-lg-4">
      <a href="{{url('/loan/request/approves')}}">
        <div class="info-box">
        <span class="info-box-icon bg-light-blue"><i class="fa fa-server"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Loan Request Approves</span>
          <span class="info-box-number">{!!  number_format($loanRequestApprovesCount, 2, '.', ',')  !!}</span>
        </div>
      </div>
     </a>
    </div>
</section>
@endif

{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $systemuserchart->script() !!}



@if(Auth::user()->hasRole('developer') ||
Auth::user()->hasRole('manager') ||
Auth::user()->hasRole('administrator'))
<!-- Main content -->
<section class="content">
    <h1>
        <strong>Dashboard</strong>
    </h1>
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="{{ url('/product/uploads') }}" style="color: black">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-product-hunt"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">No of Products</span>
          <span class="info-box-number">{{ number_format($comparisonCount[0]->comparisonCount, 2, '.', ',') }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </a>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="{{ url('/product/inquries/download') }}"  style="color: black">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-download"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Download Report</span>
          <span class="info-box-number">{!! number_format($downloadReportCount, 2, '.', ',') !!}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </a>
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="{{ url('/product/inquries/callme') }}"  style="color: black">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-mobile"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Call Me Report</span>
          <span class="info-box-number">{!! number_format($callMeCount, 2, '.', ',') !!}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </a>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="{{ url('/total/compare/loans') }}"  style="color: black">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-object-group"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">No of Compares</span>
          <span class="info-box-number">{{ number_format($loanscomparisonCount[0]->loanscomparisonCount, 2, '.', ',') }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </a>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  {{--  row  --}}
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="{{ url('/product/inquries') }}"  style="color: black">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-hdd-o"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">No of Inquiries</span>
            <span class="info-box-number">{{ number_format($numberofInquiriesCount[0]->numberofInquiriesCount, 2, '.', ',') }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </a>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="{{ url('/institution/types') }}"  style="color: black">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-university"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">No of Institution Types</span>
          <span class="info-box-number">{{ number_format($institutionTypeCount[0]->institutionTypeCount, 2, '.', ',') }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </a>
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>
    <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="{{ url('/loan/types') }}"  style="color: black">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">No of Loan Types</span>
          <span class="info-box-number">{{ number_format($loanTypeCount[0]->loanTypeCount, 2, '.', ',') }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </a>
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <a href="{{ url('/view/all/users') }}"  style="color: black">
        <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">System Users</span>
          <span class="info-box-number">{{ number_format($numberofusersCount[0]->numberofusersCount, 2, '.', ',') }}</span>
        </div>
        <!-- /.info-box-content -->
        </a>
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  {{--  row  --}}

    {{--  Another row --}}
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="#"  style="color: black">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-clock-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Average Period</span>
                <span class="info-box-number">{{ number_format($averagePeriod, 2, '.', ',') }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="#"  style="color: black">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Average Amount Requested</span>
              <span class="info-box-number">{{ number_format($averageAmount, 2, '.', ',') }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </a>
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
        <a href="#"  style="color: black">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-safari"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Average Net Salary</span>
              <span class="info-box-number">{{ number_format($averageNetSalary, 2, '.', ',') }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </a>
        </div>
        <!-- /.col -->
        <!-- /.col -->
    </div>
    {{--  Another row  --}}


  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Number Compare Report</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">

              <div class="chart">
                <canvas id="salesChart" style="height: 40px;"></canvas>
                {!! $chart->html() !!}
              </div>
              <!-- /.chart-responsive -->
            </div>
            <!-- /.col -->

            {{--  Loans Side  --}}
            <div class="col-md-4">
              <p class="text-center">
                <strong>Loans</strong>
              </p>

              <div class="progress-group">
                <a href="{{ url('/total/loans/rejected/approved') }}"  style="color: black">
                <span class="progress-text">Total Loans[Rejected/Approved]</span>
                <span class="progress-number">{{ number_format($totalLoansCount[0]->totalLoansCount, 2, '.', ',') }}</span>

                <div class="progress sm">
                  <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                </div>
                </a>
              </div>
              <!-- /.progress-group -->
              <div class="progress-group">
                <a href="{{ url('/all/loan/rejected') }}"  style="color: black">

                <span class="progress-text">Loan Rejected</span>
                <span class="progress-number">{!! number_format($allloanRejectedDashboardCount, 2, '.', ',') !!}</span>

                <div class="progress sm">
                  <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                </div>
                </a>
              </div>
              <!-- /.progress-group -->
              <div class="progress-group">
                <a href="{{ url('/total/loan/approved') }}"  style="color: black">
                <span class="progress-text">Loan Approved</span>
                <span class="progress-number">{!! number_format($loanapprovedDashboardCount, 2, '.', ',') !!}</span>

                <div class="progress sm">
                  <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                </div>
                </a>
              </div>
              <!-- /.progress-group -->

              <div class="progress-group">
                <a href="{{ url('/loan/requests') }}"  style="color: black">
                <span class="progress-text">Loan Applied</span>
                <span class="progress-number">{!! number_format($loanappliedDashboardCount, 2, '.', ',') !!}</span>

                <div class="progress sm">
                  <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                </div>
              </a>
              </div>
              <!-- /.progress-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- ./box-body -->
        <div class="box-footer">
          <div class="row">
            <div class="col-sm-3 col-xs-6">
                <a href="{{ url('/product/inquries') }}"  style="color: black">
              <div class="description-block border-right">
                <h5 class="description-header">{{ number_format($numberofInquiriesCount[0]->numberofInquiriesCount, 2, '.', ',') }}</h5>
                <span class="description-text">Total Inquires</span>
              </div>
              <!-- /.description-block -->
                </a>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-xs-6">
                <a href="{{ url('/loan/requests') }}"  style="color: black">
              <div class="description-block border-right">
                <h5 class="description-header">{!! number_format($loanappliedDashboardCount, 2, '.', ',') !!}</h5>
                <span class="description-text">Total Loan Applied</span>
              </div>
              <!-- /.description-block -->
                </a>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-xs-6">
                <a href="{{ url('/total/loan/approved') }}"  style="color: black">
              <div class="description-block border-right">
                <h5 class="description-header">{!! number_format($loanapprovedDashboardCount, 2, '.', ',') !!}</h5>
                <span class="description-text">Total Loan Approved</span>
              </div>
              <!-- /.description-block -->
                </a>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 col-xs-6">
                <a href="{{ url('/all/loan/rejected') }}"  style="color: black">
              <div class="description-block">
                <h5 class="description-header">{!! number_format($allloanRejectedDashboardCount, 2, '.', ',') !!}</h5>
                <span class="description-text">Total Loan Rejected</span>
              </div>
              <!-- /.description-block -->
                </a>
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <div class="col-md-8">
      <!-- MAP & BOX PANE -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">System Users Report</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <div class="row">
            <div class="col-sm-8">
                <div class="chart">
                    <canvas id="salesChart" style="height: 40px;"></canvas>
                    {!! $systemuserchart->html() !!}
                  </div>
            </div>
            <!-- /.col -->
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

      <!-- /.row -->
      <!-- /.box -->
    </div>
    <!-- /.col -->

    <div class="col-md-4">
      <!-- Info Boxes Style 2 -->
      <div class="info-box bg-yellow">
        <span class="info-box-icon"><i class="fa fa-object-group"></i></span>

        <div class="info-box-content">
            <a href="{{ url('/total/compare/loans') }}" style="color: white">
          <span class="info-box-text">No of Compare</span>
          <span class="info-box-number">{{ number_format($loanscomparisonCount[0]->loanscomparisonCount, 2, '.', ',') }}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 180%"></div>
          </div>
            </a>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
      <div class="info-box bg-green">
        <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>

        <div class="info-box-content">
            <a href="{{ url('/total/loans/rejected/approved') }}" style="color: white">
          <span class="info-box-text">Follow Ups</span>
          <span class="info-box-number">{{ number_format($totalLoansAssignedCount[0]->totalLoansAssignedCount, 2, '.', ',') }}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 180%"></div>
          </div>
            </a>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
      <div class="info-box bg-red">
        <span class="info-box-icon"><i class="fa fa-id-badge"></i></span>

        <div class="info-box-content">
            <a href="{{ url('/subscriber-email') }}" style="color: white">
          <span class="info-box-text">No of Subscribers</span>
          <span class="info-box-number">{{ number_format($numberofSubcribersCount[0]->numberofSubcribersCount, 2, '.', ',') }}</span>

          <div class="progress">
            <div class="progress-bar" style="width: 180%"></div>
          </div>
            </a>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
      <!-- /.info-box -->
      <!-- /.box -->

      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@endif
@endsection
