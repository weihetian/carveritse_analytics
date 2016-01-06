<?php 
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id = $_POST['deleteid'];
$sql="DELETE FROM campaign WHERE id=$id";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}



?>