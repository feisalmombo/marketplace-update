<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title style="font-family: 'Montserrat', sans-serif">Compare Product Report</title>
	<style type="text/css" media="screen">
	table{
		border: 1px solid;
		border-collapse: collapse;
		width: 100%;
		margin: 0 auto;
		text-align: left;
	}
	tr th{
		background: #eee;
		border: 1px solid;
		padding-left: 10px;
	}
	tr td{
		border: 1px solid;
		padding-left: 10px;
	}
	caption{
		text-align: center;
    }

    body {
        margin: 0;
        font-family: "Montserrat", sans-serif;
    }
</style>
</head>
<body style="font-family: 'Montserrat', sans-serif">


    <div style="text-align: center;">
        <img class="img-responsive" style="font-family: 'Montserrat', sans-serif"  src="../public/temp/images/logo.png" alt="MarketPlace Logo" width="300" >
        <br>

		<div class="text-center" style="text-align: center">
			<caption style="font-family: 'Montserrat', sans-serif">COMPARISON PRODUCT SUMMARY REPORT</caption>
		</div>
	</div>
	<br>
	<div class="panel-body table-responsive" style="font-family: 'Montserrat', sans-serif">
        @if(!empty($data) > 0)
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th>S/N</th>
                    <th>Institution Name</th>
                    <th>Interest Rate</th>
                    <th>Facility Fee</th>
                    <th>Monthly Payment</th>
                    <th>Insurance Fee</th>
                    <th>Tenure</th>
                    <th>Debt Burden Ratio</th>
                    <th>Net Amount</th>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $key => $compareloan)
				<tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $compareloan->institution_name }}</td>
                    <td>{{ number_format($compareloan->interest_rate) }}%</td>
                    <td>{{ number_format($compareloan->facilite_fee) }}</td>
                    <td>{{ number_format($compareloan->repayment) }}</td>
                    <td>{{ number_format($compareloan->insurance_fee) }}</td>
                    <td>{{ number_format($compareloan->duration) }}</td>
                    <td>{{ number_format($compareloan->dir) }}%</td>
                    <td>{{number_format($compareloan->net_amount) }}</td>
				</tr>
				@endforeach
			</tbody>
        </table>
        @else
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong style="font-family: 'Montserrat', sans-serif">No Comparison Summary found</strong>
        </div>
        @endif
	</div>
</body>
</html>
