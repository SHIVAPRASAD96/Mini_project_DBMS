<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="cs01.css">
  <link rel="stylesheet" href="Boot/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="Boot/	js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <div class="jumbotron">
    <h1>Analysis of results</h1>
    <p>Here we show the graphical representation of students scored <35 , >35 to 50 , >60 ,>50 ,>70</p>
  </div>
</div>
</body>
</html>

<?php
//connect to the database
$con = mysqli_connect("localhost","root","","a_database");
session_start();

$sql1 = "SELECT count(total) as tot FROM flat_bit WHERE total <35 group by total";
				
$sql2 = "SELECT count(total) as tot FROM flat_bit WHERE total >50 And total <60 group by total ";

$sql3 = "SELECT count(total) as tot FROM flat_bit WHERE total >60 AND total<70 group by total ";

$sql4 = "SELECT count(total) as tot FROM flat_bit WHERE total >70 group by total ";

$q1 = mysqli_query( $con, $sql1);

$q2 = mysqli_query( $con, $sql2);

$q3 = mysqli_query( $con, "select * from flat_bit WHERE  total>=50 group by total");

$q4 = mysqli_query( $con, "select * from flat_bit WHERE total>=60 group by total");

$q5 = mysqli_query( $con, "select * from flat_bit WHERE total>=70 group by total");
?>


﻿<!DOCTYPE HTML>
<html>
<head>
<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{
		theme: "theme2",
		title:{
			text: "Score Distribution"
		},
		data: [
		{
			type: "pie",
			showInLegend: true,
			toolTipContent: "{total} - #percent %",
			yValueFormatString: "#0.#,,. number	",
			legendText: "{indexLabel}",
			dataPoints: [
				
				<?php while( $row = mysqli_fetch_assoc( $q1)){?>
					{	
						y: <?php echo $row['tot']?>, 
						indexLabel: "less than 35" 
					},
				<?php } ?>	
				<?php while( $row = mysqli_fetch_assoc( $q2)){?>
					{	
						y: <?php echo $row['tot']?>, 
						indexLabel: "more than 35 and less than 50" 
					},
				<?php } ?>
				
			]
		}
		]
	});
	chart.render();
}
	</script>
	<script src="canvasjs.min.js"></script>
	
</head>
<body>
	<div id="chartContainer" style="height: 400px; width: 100%;"></div>
</body>
</html>
?>