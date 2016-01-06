<?php

$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
$devices = array();
$campaignid=$_GET['id'];
$start = $_GET['start'];
$end = $_GET['end'];
$theresult=array();
$result = mysqli_query($con,"SELECT * FROM device WHERE campaignid = $campaignid")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result)) {
		
		$devices[]= $row['deviceid'];
	}


foreach($devices as $d)
{
//echo $item->properties->deviceId;
$ajson = file_get_contents('http://map.foxtraxgps.com/service/v1.0/device-history?device-id='.$d.'&start='.$start.'&end='.$end.'&format=json&api_key=2603f74f-b3b4-3ca9-7b5a-00000648c8df');
$aobj = json_decode($ajson);
if (is_array($aobj->features))
{
foreach($aobj->features as $aitem){
$theresult[]=$aitem;}
}}
echo json_encode($theresult);
?>