<?php 
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id = $_POST['id'];
$info = addslashes(mysqli_real_escape_string($con,$_POST['info']));
$sql="UPDATE device
SET info='$info'
WHERE id='$id';";


if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}

$finfo = str_replace(array('\r\n', '\r', '\n',"\\r","\\n","\\r\\n"), "<br />", $info); 
		$finfo = str_replace(array("'"), " ", $finfo); 
echo $_POST['info'];


?>