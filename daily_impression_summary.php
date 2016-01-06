<?php
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$theresult=array();
$result = mysqli_query($con,"SELECT * FROM impression_report WHERE datetime BETWEEN '2014-10-16' AND '2014-11-01'")or die("Error: ".mysqli_error($con));
  while($row = mysqli_fetch_array($result)) {
	$date = date('Y-m-d', strtotime($row['datetime']));
	$device = $row['deviceid'];
	$impression = $row['impression'];
	$city = $row['city'];
	$theresult[$date][$device][$city] += $impression;
	
}

foreach ($theresult as $d=>$de) {
  echo "data: " . $d ."<br>";
   foreach ($de as $id=>$city)
   {
   	foreach ($city as $name=>$im)
   	{
   		$query = "SELECT * from impression_daily_report WHERE deviceid='$id' AND date ='$d'";
$result2 = mysqli_query($con,$query);

		 echo "device: ".$id." city:".$name." impression: " . $im ."date: ".$d."<br>";
  // $result = mysqli_query($con,"INSERT INTO impression_daily_report (deviceid, city,impression,date) VALUES('$id','$name','$im','$d')")or die("Error: ".mysqli_error($con));


   		
   	 //$result = mysqli_query($con,"INSERT INTO impression_daily_report (deviceid, city,impression,date) VALUES('$id','$name','$im','$d')")or die("Error: ".mysqli_error($con));

   	 }
   	 
   }
}

?>