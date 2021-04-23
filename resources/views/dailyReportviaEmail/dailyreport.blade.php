<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MarketPlace Summary Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <div>
        <h2>Hello Dear</h2> 

         <p>Total Compare: {{ number_format($compareloans, 2, '.', ',') }}</p>
         <p>Average Period: {{ number_format($averagePeriod, 2, '.', ',') }}</p>
         <p>Average Amount: {{ number_format($averageAmount, 2, '.', ',') }}</p>
         <p>Download Report: {{ number_format($downloadReport, 2, '.', ',') }}</p>
         <p>Call Me Report: {{ number_format($callMeReport, 2, '.', ',') }}</p>
         <p>Total Application: {{ number_format($totalApplication, 2, '.', ',') }}</p>

         Thanks,<br>
        <p>{{ config('app.name') }}</p>
    </div>
</body>
</html>
