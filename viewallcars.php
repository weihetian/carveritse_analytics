<?php

$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id=$_GET['id'];

$result = mysqli_query($con,"SELECT * FROM campaign WHERE id = $id")or die("Error: ".mysqli_error($con));

while($row = mysqli_fetch_array($result)) {
$name = $row['name'];
}
				


?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <title>Campaign</title>
	<link href="css/_admin.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
	 <link href="css/bootstrap.min.css" rel="stylesheet" media="all" >
        
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

        
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=visualization"></script>
        <script type="text/javascript">
            // When the window has finished loading create our google map below
         
        </script>
        <script src="js/Chart.js"></script>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  
	 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>


	 <link rel="stylesheet" href="css/jquery.shadow.css" />
	 <script src="js/jquery.shadow.js"></script>  
</head>
<body>
<div class="main">
	<div class="container">
		<div class="page-header">
			<?php
			echo "
			<h1>$name <small>proof of performance</small></h1></div>
			";
			
			$result = mysqli_query($con,"SELECT * FROM device WHERE campaignid = $id")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result)) {
		$id = $row['id'];
		$deviceid = $row['deviceid'];
		$carid = $row['carid'];
		$rawinfo = $row['info'];
		
		
		$info = str_replace(array('\r\n', '\r', '\n'), "<br />", $rawinfo); 
		$info = str_replace(array("'"), " ", $info); 
		$front = $row['front'];	
		$back = $row['back'];	
		$left = $row['leftpic'];	
		$right = $row['rightpic'];		
		echo "<div class='panel panel-default box'>
 			 <div class='panel-body proof'>
				<div class='col-xs-4 col-md-4'>
					<p>$info </p>
				</div>
				<div class='col-xs-8 col-md-8'>
					<div class='row'>
					<div class='col-xs-6 col-md-6 ' >
						<img src='$front' class=' box1'>
					</div>
					<div class='col-xs-6 col-md-6 '>
						<img src='$back' class='box1'>
					</div>
					</div>
					<br>
					<div class='row'>
					<div class='col-xs-6 col-md-6 '>
						<img src='$left' class='box1'>
					</div>
					<div class='col-xs-6 col-md-6 '>
						<img src='$right' class='box1'>
					</div>
					</div>
				</div>
			  </div>
			</div>";
		}

			
			?>
			
			
		
	</div>
</div>
</body>
</html>

	 <script src='js/admin.js'></script>