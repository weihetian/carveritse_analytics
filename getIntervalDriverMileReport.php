<?php

$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");



if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$devices = array();
$campaignid=$_GET['campaignid'];

$drivermap = array();

$result = mysqli_query($con,"SELECT * FROM device WHERE campaignid = $campaignid")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result)) {
		
		$devices[]= $row['deviceid'];
		$drivermap[$row['deviceid']]=$row['drivername'];
	}


$startdate=date('Y-m-d', strtotime($_GET['startdate']));
$enddate=date('Y-m-d', strtotime($_GET['enddate']));
   $theresult=array();
  
  $result = mysqli_query($con,"SELECT * FROM miles_report WHERE date BETWEEN '$startdate' AND '$enddate' AND deviceid IN (" . implode(',', $devices) . ") ORDER BY date ASC")or die("Error: ".mysqli_error($con));

 while($row = mysqli_fetch_array($result)) {
 		$deviceid = $row['deviceid'];
 		$mile = $row['mile'];
 		$theresult[$drivermap[$deviceid]]+=$mile;			
 }
 arsort($theresult);

echo json_encode($theresult);


?>