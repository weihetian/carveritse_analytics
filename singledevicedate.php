<?php

$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$devices = array();
$deviceid=$_GET['id'];
$start = $_GET['start'];
$end = $_GET['end'];
$theresult=0;
$result = mysqli_query($con,"SELECT * FROM miles_report WHERE date BETWEEN '$start' AND '$end' AND deviceid = '$deviceid'")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result)) {
		
		 		$theresult = $theresult+$row['mile'];
	}


echo $theresult;
?>