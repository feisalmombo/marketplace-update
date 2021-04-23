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
        <h2> Hi {{ $sendName }} !!!</h2>
         <p> Now you have successfully login at Markrtplace platform with reference number:<strong> {{ $sendReferenceNumber }}</strong>.</p>
        <h5><i>Regards</i></h5>
    </div>
</body>
</html>
