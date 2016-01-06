<?php

$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");



if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
	
$campaign_id = 	$_POST["campaign_id"];

$zip_data   =   $_POST["zip"];
$zip  =    json_decode($zip_data);
$area_data   =   $_POST["area"];
$area =    json_decode($area_data);

$delete_query = "DELETE FROM group_zip WHERE campaignid = '$campaign_id'";

mysqli_query($con,$delete_query)or die("Error: ".mysqli_error($con));


foreach ($zip as $single_zip){
	$zipcode = $single_zip->zip;
	$area_id=$single_zip->area_id;
	
	$query = "INSERT INTO group_zip (campaignid,zip,areaid) VALUES('$campaign_id','$zipcode','$area_id')";
	mysqli_query($con,$query)or die("Error: ".mysqli_error($con));
	
}

	
$delete_query = "DELETE FROM group_area WHERE campaignid = '$campaign_id'";

mysqli_query($con,$delete_query)or die("Error: ".mysqli_error($con));


foreach ($area as $single_area){
	$area_id = $single_area->id;
	$name=$single_area->name;
	
	$query = "INSERT INTO group_area (campaignid,area_id,name) VALUES('$campaign_id','$area_id','$name')";
	mysqli_query($con,$query)or die("Error: ".mysqli_error($con));
	
	
}

mysql_close($con);
	
	
?>