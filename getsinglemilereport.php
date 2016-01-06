<?php

$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");



if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $devices = array();
$deviceid=$_GET['deviceid'];


  
  $startdate=date('Y-m-d', strtotime($_GET['startdate']));
$enddate=date('Y-m-d', strtotime($_GET['enddate']));

   $theresult=array();
  
  $result = mysqli_query($con,"SELECT * FROM miles_report WHERE date BETWEEN '$startdate' AND '$enddate' AND deviceid = '$deviceid'")or die("Error: ".mysqli_error($con));

 while($row = mysqli_fetch_array($result)) {
 		$city = $row['city'];
 		$mile = $row['mile'];
 		$theresult[$city]+=$mile;				
 }
 arsort($theresult);

echo json_encode($theresult);


?>