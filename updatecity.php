<?php
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$distance = 10;
 $result = mysqli_query($con,"SELECT * FROM impression_report WHERE city = ''  ")or die("Error: ".mysqli_error($con));
   while($row = mysqli_fetch_array($result)) {
   $ozip = $row['zipcode'];
  echo "id".$row['id']." zip: ".$row['zipcode']."  city: ".$row['city']."</br>";
  
  $latitude = $row['lat'];
  $longitude = $row['lon'];
  
  // $latitude = $feature->geometry->coordinates[1];
     $latceil =ceil($latitude);
    $latfloor = floor($latitude);
	//$longitude =  $feature->geometry->coordinates[0];
	$lngceil =ceil($longitude);
    $lngfloor = floor($longitude);
  
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
  
$result3 = mysqli_query($con,$sql)or die("Error: ".mysqli_error($con));

		 while($row3 = mysqli_fetch_array($result3)) {
// 		//echo "lsl";
 		$city = $row3['primary_city'];
 		$zip = $row3['zip'];
 		//$lat = $row3['latitude'];
 		//$lon = $row3['longitude'];
  $result1 = mysqli_query($con,"UPDATE impression_report SET city='$city' WHERE lat = '$latitude' AND lon = '$longitude'")or die("Error: ".mysqli_error($con));		
 }
 //  	if(strlen($ozip) > 5){
//   	$zip =  substr($row['zipcode'], 0, 5);
//  		$result1 = mysqli_query($con,"SELECT * FROM zipcode WHERE zip = '$zip'")or die("Error: ".mysqli_error($con));			
//  		while($row2 = mysqli_fetch_array($result1)) {
// 		
// 		$city= $row2['primary_city'];
// 		$result1 = mysqli_query($con,"UPDATE impression_report SET city='$city' WHERE zipcode = '$ozip'")or die("Error: ".mysqli_error($con));			
//  		echo "zip: ".$zip."  city: ".$city."</br>";		
//   	}}
//   	else{
//  		$zip =  substr($row['zipcode'], 0, 5);
//  		$result1 = mysqli_query($con,"SELECT * FROM zipcode WHERE zip = '$zip'")or die("Error: ".mysqli_error($con));			
//  		while($row2 = mysqli_fetch_array($result1)) {
// 		
// 		$city= $row2['primary_city'];
// 		$result1 = mysqli_query($con,"UPDATE impression_report SET city='$city' WHERE zipcode = '$ozip'")or die("Error: ".mysqli_error($con));			
//  		echo "zip: ".$zip."  city: ".$city."</br>";		
// 	}
// 	}
	
 }
 
 echo "finally done";


?>