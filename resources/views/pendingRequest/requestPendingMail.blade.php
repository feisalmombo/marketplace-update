<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <div>
        <h2>Hello {{ $borrowerName }}</h2>
         <p>Your loan request is pending bank’s approval.</p>
         Thanks,<br>
        <p>{{ config('app.name') }}</p>
    </div>
</body>
</html>
