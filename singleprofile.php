<?php
session_start();
$deviceid = $_SESSION['deviceid'];
			$id=$_SESSION['campaign_id'];
			$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$result = mysqli_query($con,"SELECT * FROM device WHERE campaignid = '$id' AND deviceid = '$deviceid'")or die("Error: ".mysqli_error($con));

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
		if($front==null)
		{
		$front = "http://cdn.flaticon.com/png/256/26886.png";
		}
		$back = $row['back'];
		if($back==null)
		{
		$back = "http://cdn.flaticon.com/png/256/26886.png";
		}	
		$left = $row['leftpic'];	
		if($left==null)
		{
		$left = "http://cdn.flaticon.com/png/256/26886.png";
		}
		$right = $row['rightpic'];
		if($right==null)
		{
		$right = "http://cdn.flaticon.com/png/256/26886.png";
		}		
		$driverpic=$row['driverpic'];
		if($driverpic == null)
		{
		$driverpic = "http://www.easyvectors.com/assets/images/vectors/afbig/d54c83eace7bec370da9df645bd15ab5-man-silhouette-clip-art.jpg";
		}
		echo "
	<div class='col-md-12 panel panel-default' style='padding-top:20px;padding-bottom:20px;'>

<div class='col-md-6 col-md-offset-1'>
	<div id='namepanel'>
	 $driver
	</div>
</br>
	<div  id='infopanel'>
  
    $info
	</div>
</div>

</div>
<div class='col-md-12' style='margin-top:50px;padding-bottom:50px;border-top:1px solid #E8E8E8;'>
   <div class='col-md-3'>
				  <h4>front:</h4>
				  
  <img src='$front' style='width:100%;box-shadow: 0px 1px 5px #888888;'>

  </div>
				<div class='col-md-3'>
				<h4>back:</h4>
  <img src='$back' style='width:100%;box-shadow: 0px 1px 5px #888888;'>
  </div>
  <div class='col-md-3'>
  <h4>left:</h4>
  <img src='$left' style='width:100%;box-shadow: 0px 1px 5px #888888;'>
  </div>
  <div class='col-md-3'>
  <h4>right:</h4>
  <img src='$right' style='width:100%;box-shadow: 0px 1px 5px #888888;'>
  </div>
</div>

";
			
				  
		}



?>

<script>
$(document).ready(function() {
  var info = document.getElementById('infopanel');
 

 var height = $('#picpanel').height();
$('#infopanel').css(height:height);
          //  info.height = height;
 });
 </script>