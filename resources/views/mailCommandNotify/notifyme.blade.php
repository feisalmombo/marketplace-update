<!DOCTYPE html>
<html lang="en">
<head>
<title>MarketPlace Daily Report</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
* {
  box-sizing: border-box;
}
body {
  font-family: Montserrat, sans-serif;
}
/* Style the header */
header {
  background-color: #2B3483;
  padding: 5px;
  text-align: center;
  font-size: 12px;
  color: white;
}
/* Style the list inside the menu */
nav ul {
  list-style-type: none;
  padding: 0;
}
article {
  float: left;
  padding: 20px;
  width: 100%;
  background-color: #f1f1f1;
  height: auto;
}
section:after {
  content: "";
  display: table;
  clear: both;
}
footer {
  background-color: #2B3483;
  padding: 2px;
  text-align: center;
  color: white;
}
footer a {
  background-color: #2B3483;
  padding: 2px;
  text-align: center;
  color: white;
}
@media (max-width: 600px) {
  nav, article {
    width: 100%;
    height: auto;
  }
}
</style>
</head>
<body>


<header>
  <h2>MarketPlace Daily Report</h2>
</header>

<section>


  <article>
    <div class="container">
        <div> 
            1. Number of Comparisons: {{ number_format($compareloans, 2, '.', ',') }}
        </div>
        <br>
    
        <div>
            2. Number of Call Requests: {{ number_format($callMeReport, 2, '.', ',') }}
        </div>
        <br>
    
        <div>
            3. Number of Downloaded Reports: {{ number_format($downloadReport, 2, '.', ',') }}
        </div>
        <br>
    
        <div>
            4. Number of Applications: {{ number_format($totalApplication, 2, '.', ',') }}
        </div>
    </div>

  </article>
</section>
<footer>
    <div>
        <p>
            Regards, <br>
            <p>{{ config('app.name') }}</p>
        </p>
    </div>
</footer>
</body>
</html>
