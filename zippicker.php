
<?php



$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");

// Check connection



if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  




$distance = 10;
$coordinates=json_decode($_POST['myData']);
 //echo "ok";
$theresult=array();
//$result = ["a","b","c","d"];

 foreach ($coordinates as $location) {
 
    $latitude = $location[0];
    $latceil =ceil($latitude);
    $latfloor = floor($latitude);
	$longitude =  $location[1];
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
  
$result = mysqli_query($con,$sql)or die("Error: ".mysqli_error($con));

		 while($row = mysqli_fetch_array($result)) {
// 		//echo "lsl";
 		$city = $row['primary_city'];
 		$theresult[]=$city;
 		}
		
}

//echo $_POST['myData'];
//echo "slsl";
echo json_encode($theresult);


mysqli_close($con);


// $latitude = $_GET['lat'];
// $longitude =  $_GET['lng'];
// 
// $sql = "SELECT *, (((acos(sin(($latitude*pi()/180)) * sin((`latitude`*pi()/180))+cos(($latitude*pi()/180)) * cos((`latitude`*pi()/180)) * cos((($longitude - `longitude`)*pi()/180))))*180/pi())*60*1.1515) AS `distance` FROM zipcode HAVING distance < $distance ORDER BY distance ASC LIMIT 1";
// 
//   
// $result = mysqli_query($con,$sql)or die("Error: ".mysqli_error($con));
// 
// 		while($row = mysqli_fetch_array($result)) {
// 		//echo "lsl";
// 		$zip = $row['primary_city'];
// 		echo $zip;
// 	}
		

?>