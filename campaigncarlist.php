

<?php

$campaignid=$_GET['id'];
echo "<input type='hidden' id='carlistcampaignid' value='$campaignid'></input>";

echo "<h3>Cars<div class='pull-right'><button type='button' class='btn btn-primary' onclick='addcar($campaignid)'><i class='fa fa-plus-circle'></i></button></div></h3>
			
			<div id='addcar_area'>
			
			</div>
			
			
			";

$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$campaignid=$_GET['id'];

$result = mysqli_query($con,"SELECT * FROM device WHERE campaignid = '$campaignid' ORDER by id DESC")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result)) {
		 $id= $row['id'];
		$driver = $row['drivername'];
		$deviceid = $row['deviceid'];
			echo "<div class='a_campaign_car' id='a_campaign_car$id' style='cursor:pointer;' onclick='showcampaigncar($id)'>
				<div class='row'>
					<div class='col-md-12'>$driver
							<div class='pull-right'><i class='fa fa-times icon_button' onclick='deletedriver($id)' ></i></div>
					</div>
				</div>
				
				</div>
				
				
				";
		}


?>	

<script>

function deletedriver(id)
{
var dataString = 'deleteid='+ id;
    if (confirm("Are you sure you want to delete this driver?") == true) {
        $.ajax({
 type: "POST",
  url: "deletedriver.php",
  datatype: "html",
  data: dataString,
  success: function(data) {
  
		caradd_update();
  }});
    } else {
        
    }
}

function addcar(id)
{
$("#addcar_area").load('caradd.php?id='+id);
}

function addcar_cancel()
{
$("#addcar_area").html("");
}


</script>