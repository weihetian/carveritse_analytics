<?php
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$xml=simplexml_load_file(dirname(dirname( dirname(__FILE__)))."/20141101 SAMI DATA.xml");
foreach($xml->children() as $child) {
 // echo $child->getName() . ": " . $child->DeviceNo . "<br>";
  $deviceid =$child->DeviceNo;
  $datetime = $child->DateTime;
  $time = date("Y/m/d H:i:s", strtotime($datetime));
  
   echo "time: " . date("Y/m/d H:i:s", strtotime($datetime)) . "<br>";
  $lon=$child->Longitude;
  $lat=$child->Latitude;
  $dec = $child->DEC;
  $zipcode = $child ->ZipCode;
 // $result = mysqli_query($con,"INSERT INTO impression_report (deviceid, datetime,lon,lat,impression,zipcode) VALUES('$deviceid','$time','$lon','$lat','$dec','$zipcode')")or die("Error: ".mysqli_error($con));
  }
?>