<?php
	session_start();
   //Read your session (if it is set)
   if (isset($_SESSION['admin']))
	{
      if( $_SESSION['admin']!="advertiser")
	  {
	  header('Location: index.html');
	  }
	  }else
	  {
	  header('Location: index.html');
	  }
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


			$name = $_SESSION['campaign_name'];
			$id=$_SESSION['campaign_id'];

$deviceid=$_GET['id'];

$result = mysqli_query($con,"SELECT * FROM device WHERE campaignid = '$id' AND id = '$deviceid'")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result)) {
		 $id= $row['id'];
		$deviceid = $row['deviceid'];
		$carid = $row['carid'];
		$driver = $row['drivername'];
		$rawinfo = $row['info'];
		
		$dinfo = str_replace(array("'"), " ", $rawinfo); 
		$dinfo = str_replace(array('\r\n', '\r', '\n'), "\n", $dinfo);
		
		$info = str_replace(array('\r\n', '\r', '\n'), "<br />", $rawinfo); 
		$info = str_replace(array("'"), " ", $info); 
		$front = $row['front'];	
		$back = $row['back'];	
		$left = $row['leftpic'];	
		$right = $row['rightpic'];		
		echo "<div class='col-md-12'>$info
			<br>
				</div>
			
				  <div class='col-md-12'>
				  front:<br>
  <img src='$front' style='width:100%;'>

  </div>
				<div class='col-md-12'>
				back:<br>
  <img src='$back' style='width:100%;'>
  </div>
  <div class='col-md-12'>
  left:<br>
  <img src='$left' style='width:100%;'>
  </div>
  <div class='col-md-12'>
  right:<br>
  <img src='$right' style='width:100%;'>
  </div>";
		}


?>	