<?php

$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");



if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $devices = array();
$campaignid=$_GET['id'];
$result = mysqli_query($con,"SELECT * FROM device WHERE campaignid = $campaignid")or die("Error: ".mysqli_error($con));

class Driver
{
    public $id;
    public $carid;
    public $deviceid;
    public $drivername;
    public $campaignid;
    public $info;
    public $front;
    public $back;
    public $left;
    public $right;
}

$drivers = array();

		while($row = mysqli_fetch_array($result)) {
		$driver = new Driver();
	$driver->id = $row['id'];
	$driver->carid = $row['carid'];
	$driver->deviceid=$row['deviceid'];
	$driver->drivername =$row['drivername'];
	$driver->campaignid = $row['campaignid'];
	$driver->info = $row['info'];
	$driver->front=$row['front'];
	$driver->back =$row['back'];
	$driver->left=$row['leftpic'];
	$driver->right =$row['rightpic'];
		$drivers[]= $driver;
	}


echo json_encode($drivers);


?>