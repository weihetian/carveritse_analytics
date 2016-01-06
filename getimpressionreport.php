<?php

$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");



if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $devices = array();
$campaignid=$_GET['campaignid'];
$result = mysqli_query($con,"SELECT * FROM device WHERE campaignid = $campaignid")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result)) {
		
		$devices[]= $row['deviceid'];
	}

  
  $startdate=date('Y-m-d', strtotime($_GET['startdate']));
$enddate=date('Y-m-d', strtotime($_GET['enddate']));

   $theresult=array();
  
  $result = mysqli_query($con,"SELECT * FROM impression_daily_report WHERE date BETWEEN '$startdate' AND '$enddate' AND deviceid IN (" . implode(',', $devices) . ")")or die("Error: ".mysqli_error($con));

 while($row = mysqli_fetch_array($result)) {
 		$city = $row['city'];
 		$impression = $row['impression'];
 		$theresult[$city]+=$impression;				
 }
 
 // foreach ($theresult as $city => $impression)
 // {
 //
 // 	// $thecounty = $row['county'];
 // 	//$countyresult[$city]+=$mile;
 //
 //
 // 	 $county = mysqli_query($con, "SELECT * FROM zipcode WHERE primary_city ='$city' AND (state = 'PA' OR state ='DE' OR state='NJ') LIMIT 1 ")or die("Error: ".mysqli_error($con));
 // 	 while($row = mysqli_fetch_array($county)) {
 // 		 $thecounty = $row['county'];
 // 		$countyresult[$thecounty]+=$impression;
 // //$countyresult[$city]+=$mile;
 //
 // 	 }
 //
 //
 // }
//  arsort($theresult);
//
// echo json_encode($theresult);

//  arsort($countyresult);
//
// echo json_encode($countyresult);
 
 arsort($theresult);

echo json_encode($theresult);


?>