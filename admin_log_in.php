<?php
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$account=$_POST['account'];
$password=$_POST['password'];
 
if($account !=''||$password !=''){
	//Insert query
	$result = mysqli_query($con,"SELECT * FROM admin WHERE account = '$account'");
	$num_rows = mysqli_num_rows($result);
	if($num_rows == 0)
	{
		$result = mysqli_query($con,"SELECT * FROM campaign WHERE account = '$account'");
				$num_rows = mysqli_num_rows($result);
				if($num_rows == 0)
				{
				echo "Acoount doesn't exit";
				}
				else
				{
				while($row = mysqli_fetch_array($result))
				{
				$realpassword = $row['password'];
				$campaign_name = $row['name'];
				$campaign_id = $row['id'];

				$campaign_start =  $row['start'];
				}
				if($password == $realpassword)
				{
				session_start();
					$_SESSION['admin'] = "advertiser";
					$_SESSION['campaign_id'] = $campaign_id;
					$_SESSION['campaign_name'] = $campaign_name;
					$_SESSION['campaign_date'] = $campaign_start;
					echo "advertiser";
				}else
				{
			
					echo "Wrong password";
				}
			}
			
	}
	else
	{
		while($row = mysqli_fetch_array($result))
		{
			$realpassword = $row['password'];
		}
		if($password == $realpassword)
		{
		session_start();
			$_SESSION['admin'] = "admin";
			echo "admin";
		}else
		{
				echo "Wrong password";
		}
	}
}
else
{
	echo "please enter both account and password";
}
//connection closed

mysqli_close($con);
?>

