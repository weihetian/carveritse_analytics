<?php
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$name=$_POST['campaignname'];
$account=$_POST['advertisername'];
$password=$_POST['advertiserpassword'];
$start=date('Y-m-d', strtotime($_POST['campaignstart']));
$end=date('Y-m-d', strtotime($_POST['campaignend']));


$sql="INSERT INTO campaign (name,account, password, start,end)
VALUES ('$name','$account', '$password','$start',' $end')";

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}


mysqli_close($con);
echo "succeed";


?>