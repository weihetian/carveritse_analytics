<?php
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$deviceids = array(39049,41023,37797,39048,40059,37479,40417,39046,41026,37475,43889);

$date = date("Y-m-d", time() - 60 * 60 * 24);
  $result = mysqli_query($con,"SELECT * FROM miles_report WHERE date ='$date' AND deviceid IN (".implode(',', $deviceids).") ")or die("Error: ".mysqli_error($con));
$row = mysqli_fetch_array($result); 
$num_results = mysqli_num_rows($result); 
$index=0;
if ($num_results > 0){ 
echo "done";

}else{

echo "Start collecting ".$date." data";

if (is_array($deviceids))
{
foreach($deviceids as $device)
	{
	
	$index++;
		

$start=$date;
$end=date('Y-m-d');

$json = file_get_contents('http://map.foxtraxgps.com/service/v1.0/device-history?device-id='.$device.'&start='.$start.'&end='.$end.'&format=json&api_key=2603f74f-b3b4-3ca9-7b5a-00000648c8df');

$distance = 10;
$json=json_decode($json);
 //echo "ok";
$theresult=array();
//$result = ["a","b","c","d"];
//$json_array as $json)
$lastpoint = $json->features[0]->geometry->coordinates;
$thispoint;

if (is_array($json->features)){
 foreach ($json->features as $feature) {
// echo $feature->geometry->coordinates[0];
     $latitude = $feature->geometry->coordinates[1];
     $latceil =ceil($latitude);
    $latfloor = floor($latitude);
	$longitude =  $feature->geometry->coordinates[0];
	$lngceil =ceil($longitude);
    $lngfloor = floor($longitude);
    $mile = 0;
 //   $lastpoint = $feature->geometry->coordinates;
    $thispoing = $feature->geometry->coordinates;
    $mile = distance($lastpoint[1],$lastpoint[0], $thispoing[1], $thispoing[0], "K");
   //  echo $lastpoint[1]."___".$lastpoint[0]."___".$thispoing[1]."___".$thispoing[0]."___";
 //   echo $mile."___----___";
    $lastpoint=$thispoing;
	
	$sql = "SELECT *, (((acos(sin(($latitude*pi()/180)) * sin((`latitude`*pi()/180))+cos(($latitude*pi()/180)) * cos((`latitude`*pi()/180)) * cos((($longitude - `longitude`)*pi()/180))))*180/pi())*60*1.1515) AS `distance` 
	FROM zipcode
	WHERE (
	latitude BETWEEN '$latfloor' AND '$latceil' 
	AND 
	longitude BETWEEN '$lngceil' AND '$lngfloor'
	)
	HAVING distance < $distance ORDER BY distance ASC LIMIT 1";
	//$sql = "SELECT *, (((acos(sin(($latitude*pi()/180)) * sin((`latitude`*pi()/180))+cos(($latitude*pi()/180)) * cos((`latitude`*pi()/180)) * cos((($longitude - `longitude`)*pi()/180))))*180/pi())*60*1.1515) AS `distance` FROM zipcode HAVING distance < $distance ORDER BY distance ASC LIMIT 1";
	//$theresult[]=[$latitude,$longitude];
  
$result = mysqli_query($con,$sql)or die("Error: ".mysqli_error($con));

		 while($row = mysqli_fetch_array($result)) {
// 		//echo "lsl";
 		$city = $row['primary_city'];
 		$zip = $row['zip'];
 		$lat = $row['latitude'];
 		$lon = $row['longitude'];
 		//echo $city;
 		//$theresult[]=$city;
 	//	echo $city." coordinates: ".$lastpoint[1]."_".$lastpoint[0]."_".$thispoing[1]."_".$thispoing[0]." mile: ";
 	//	echo $mile;
 		$theresult[$city]+=$mile;
 		//echo $device." ".$city." ".
 		}
		
}
foreach($theresult as $key => $value){
$result = mysqli_query($con,"INSERT INTO miles_report (deviceid, city,mile,date,zip,lat,lon) VALUES('$device','$key','$value','$date','$zip','$lat','$lon')")or die("Error: ".mysqli_error($con));

}
echo "Second part DONE!!";

}}
}
}



function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}


?>
