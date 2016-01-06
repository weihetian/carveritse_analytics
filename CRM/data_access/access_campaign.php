<?php
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$id=$_POST['campaignid'];
$result = mysqli_query($con,"SELECT * FROM campaign WHERE id = '$id'");
$num_rows = mysqli_num_rows($result);
if($num_rows == 0)
{
echo "Campaign doesn't exit";
}else
{
while($row = mysqli_fetch_array($result))
{
	$realpassword = $row['password'];
	$campaign_name = $row['name'];
	$campaign_id = $row['id'];
	$campaign_start =  $row['start'];
	session_start();
$_SESSION['campaign_id'] = $campaign_id;
	$_SESSION['campaign_name'] = $campaign_name;
	$_SESSION['campaign_date'] = $campaign_start;
	
}
}
			
echo "succeed";

mysqli_close($con);
?>

