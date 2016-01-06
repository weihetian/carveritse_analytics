<?php
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// $filename = "delete.htm"; // This is at root of the file using this script.
// $fd = fopen ($filename, "r");


	 $xml=simplexml_load_file("../../20150726 SAMI DATA.xml") or die("Error: Cannot create object");
//

$index = 0;

//$theresult=array(array());
$drivermap = array();
$devices = array();
foreach($xml->Device as $device)
  {
	  $zip = $device->ZipCode;
	  $int = filter_var($zip, FILTER_SANITIZE_NUMBER_INT);

	//  echo $zip;
	  $zipcode = substr($int,-5);
	  
  	$sql = "SELECT * 
  	FROM zipcode
  	WHERE zip = $zipcode";
	if($zipcode!=""&&strlen($zipcode)==5){
  
  $result = mysqli_query($con,$sql)or die("Error: ".mysqli_error($con));

  		 while($row = mysqli_fetch_array($result)) {
   		$city = $row['primary_city'];
   		}
		
		
		
		
	  $index++;
	  $deviceid=$device->DeviceNo;
	  $date = $device->DateTime;
	  $impression=$device->DEC;
	  
	  
	//
	// $devices[]= $deviceid;
	// $drivermap[$deviceid]=$city;
	//echo $deviceid." ".$city;
  $theresult["$deviceid"]["$city"]+=$impression;
  
  
	
//   echo "id:".$index." city: ".$city."No: ".$device->DeviceNo."DEC: ".$device->DEC."Date: ".$device->DateTime."<br>";
//   $result = mysqli_query($con,"INSERT INTO impression_daily_report (deviceid, date,city,impression,zipcode
// ) VALUES('$deviceid','$date','$city','$impression','$zipcode')")or die("Error: ".mysqli_error($con));
//
}
  
  
  }
  $time = strtotime('07/25/2015');

  $date = date('Y-m-d',$time);
  
  foreach ($theresult as $singledevice => $cities) {
	  foreach ($cities as $singlecity => $impression) {
  		echo "city: ".$singlecity."No: ".$singledevice."DEC: ".$impression."<br>";
	    $result = mysqli_query($con,"INSERT INTO impression_daily_report (deviceid, date,city,impression
	    ) VALUES('$singledevice','$date','$singlecity','$impression')")or die("Error: ".mysqli_error($con));
	  }
  
  }
  
  // foreach ($devices as $single) {
  // 	  foreach ($devices as $single) {
  // 	      echo "Value: $value<br />\n";
  // 	  }
  // }

	
?>