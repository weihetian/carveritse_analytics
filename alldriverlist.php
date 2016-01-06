

<?php


$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM campaign ORDER by id DESC")or die("Error: ".mysqli_error($con));
	while($row = mysqli_fetch_array($result)) {
	 $campaignid= $row['id'];
	 $campaignname = $row['name'];
	 echo "<div class='page-header'><h4>$campaignname</h4></div>";
	$result1 = mysqli_query($con,"SELECT * FROM device WHERE campaignid = '$campaignid' ORDER by id DESC")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result1)) {
		 $id= $row['id'];
		$driver = $row['drivername'];
		$deviceid = $row['deviceid'];
			echo "<div class='a_campaign_car' id='a_campaign_car$id' style='cursor:pointer;' onclick='selectdriver($deviceid, $campaignid)'>
				<div class='row'>
					<div class='col-md-12'>$driver
						<input type='hidden' id='drivername$deviceid' value='$driver'></input>
					</div>
				</div>
				
				</div>
				
				
				";
		}
	
	}






?>	

<script>
// 
// function deletedriver(id)
// {
// var dataString = 'deleteid='+ id;
//     if (confirm("Are you sure you want to delete this driver?") == true) {
//         $.ajax({
//  type: "POST",
//   url: "deletedriver.php",
//   datatype: "html",
//   data: dataString,
//   success: function(data) {
//   
// 		caradd_update();
//   }});
//     } else {
//         
//     }
// }
// 
// function addcar(id)
// {
// $("#addcar_area").load('caradd.php?id='+id);
// }
// 
// function addcar_cancel()
// {
// $("#addcar_area").html("");
// }


</script>