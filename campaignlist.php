

<?php
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}



$result = mysqli_query($con,"SELECT * FROM campaign ORDER by id DESC")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result)) {
		 $id= $row['id'];
		$name = $row['name'];
		$account = $row['account'];
		$password=$row['password'];
		$start = $row['start'];
		$end=$row['end'];
		
			
		echo "<div class='a_campaign' id='a_campaign$id' style='cursor:pointer;' onclick='showcars($id)'>
			<div class='pull-right'><i class='fa fa-times icon_button' onclick='deletecampaign($id)' ></i></div>
			<div class='row'>
				<div class='col-md-12'>Name: $name</div>
				<div class='col-md-12'>Advertiser: $account</div>
				<div class='col-md-12'>Password: $password</div>
				<div class='col-md-12'>Start: $start</div>
				<div class='col-md-12'>End: $end</div>
				</div>
				
				</div>
				
				";
		}


?>

