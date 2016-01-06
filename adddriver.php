<?php
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$name=$_POST['drivername'];
$campaignid=$_POST['campaignid'];


$sql="INSERT INTO device (drivername,campaignid)
VALUES ('$name','$campaignid')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}


mysqli_close($con);
echo "succeed";


?>