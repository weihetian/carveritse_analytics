<?php
$con= mysqli_connect("mysql.penguinads.com", "macnag", "penguinads!","penguinads_drivers");
		// Check connection
		if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}


$carid=$_POST['carid'];
$return;
$result = mysqli_query($con,"SELECT * FROM DriverInfo WHERE DriverID = $carid")
 or die("Error: ".mysqli_error($con));

					while($row = mysqli_fetch_array($result))
					{	
						$driverid = $row['DriverID'];
						$firstname=$row['FirstName'];
						$lastname=$row['LastName'];
						$phone=$row['Phone'];
						$email=$row['Email'];
						$return.="DriverId: ".$driverid."\nFirst name: ".$firstname."\nLast name: ".$lastname."\nPhone: ".$phone."\nEmail: ".$email."\n"; 
						
						}
						
						$result = mysqli_query($con,"SELECT * FROM VehicleInfo WHERE DriverID = $carid")
 or die("Error: ".mysqli_error($con));

					while($row = mysqli_fetch_array($result))
					{	
						$year = $row['Year'];
						$make=$row['Make'];
						$model=$row['Model'];
						$color=$row['Color'];
						$condition=$row['Current_Condition'];
						$return.="Year: ".$year."\nMake: ".$make."\nModel: ".$model."\nColor: ".$color."\nCondition: ".$condition."\n"; 
						
						}
						
						$result = mysqli_query($con,"SELECT * FROM DriverHabits WHERE DriverID = $carid")
 or die("Error: ".mysqli_error($con));

					while($row = mysqli_fetch_array($result))
					{	
						
						$home_city = $row['Home_City'];
						$home_zip=$row['Home_Zip'];
						$work_city=$row['Work_City'];
						$work_zip=$row['Work_Zip'];
						$ave_monthly=$row['Avg_Monthly_Miles'];
						$comments = $row['Comments'];
						$return.="Home city: ".$home_city."\nhome zip: ".$home_zip."\nWork city: ".$work_city."\nWork Zip: ".$work_zip."\nAvg Monthly Miles: ".$ave_monthly."\nComments: ".$comments."\n"; 
						
						}

echo $return;



?>