<?php

$id=$_GET['id'];
$start = $_GET['start'];

$end = $_GET['end'];
$json = file_get_contents('http://map.foxtraxgps.com/service/v1.0/device-history?device-id='.$id.'&start='.$start.'&end='.$end.'&format=json&api_key=2603f74f-b3b4-3ca9-7b5a-00000648c8df');

$result = json_decode($json);



$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$sum=0;
$result1 = mysqli_query($con,"SELECT * FROM miles_report WHERE date = '$start' AND deviceid = '$id'")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result1)) {
		
		 		$sum = $sum+$row['mile'];
	}
	
	$sum2=0;
$result3 = mysqli_query($con,"SELECT * FROM impression_daily_report WHERE date = '$start' AND deviceid = '$id'")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result3)) {
		
		 		$sum2 = $sum2+$row['impression'];
	}


 $result2= array ('carid'=>$id, 'impression'=>$sum2,'mile'=>$sum,'path'=>$result);

echo json_encode($result2);


//echo $json;


?>