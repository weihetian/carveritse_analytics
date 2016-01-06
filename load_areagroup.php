<?php

$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");



if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
	
$campaign_id = 	$_GET["campaignid"];

$areas = array();
$zipcodes = array();

$query= "SELECT * FROM group_area WHERE campaignid='$campaign_id'";

$result = mysqli_query($con,$query)or die("Error: ".mysqli_error($con));
while($row = mysqli_fetch_array($result)) {
		$area_id = $row['area_id'];
		$name = $row['name'];
		$areas[]=array("areaid"=>$area_id,"name"=>$name);		
}


$query= "SELECT * FROM group_zip WHERE campaignid='$campaign_id'";

$result = mysqli_query($con,$query)or die("Error: ".mysqli_error($con));
while($row = mysqli_fetch_array($result)) {
		$area_id = $row['areaid'];
		$zip = $row['zip'];
		$zipcodes[]=array("areaid"=>$area_id,"zip"=>$zip);		
}

$theresult = array("areas"=>$areas,"zipcodes"=>$zipcodes);

echo json_encode($theresult);


?>