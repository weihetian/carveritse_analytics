<?php

$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");



if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$devices = array();
$campaignid="5";
$result = mysqli_query($con,"SELECT * FROM device WHERE campaignid = $campaignid")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result)) {
		
		$devices[]= $row['deviceid'];
	}


//$startdate=date('Y-m-d', strtotime($_GET['startdate']));
//$enddate=date('Y-m-d', strtotime($_GET['enddate']));
   $theresult=array();
  
  $result = mysqli_query($con,"SELECT * FROM impression_report WHERE datetime BETWEEN '2014-09-27' AND '2014-09-29' AND deviceid IN (" . implode(',', $devices) . ") ORDER BY datetime ASC")or die("Error: ".mysqli_error($con));

 while($row = mysqli_fetch_array($result)) {
 		$date = date("Y-m-d", strtotime($row['datetime']));
 		$impression = $row['impression'];
 		$theresult[$date]+=$impression;				
 }
 
 
 //arsort($theresult);

echo json_encode($theresult);


?>