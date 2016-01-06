<?php

$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");



if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  




$report=json_decode($_POST['myData']);
$date=date('Y-m-d', strtotime($report->thedate));
$deviceid=$report->deviceid;

//$theresult=array();

foreach($report->report as $key => $val)
{
  
   	 $result = mysqli_query($con,"INSERT INTO miles_report (deviceid, city,mile,date) VALUES('$deviceid','$key','$val','$date')")or die("Error: ".mysqli_error($con));
//	$theresult[]=$key;
        // echo $key . ': ' . $val;
//         echo '<br>';
    
}
//echo "good";


mysqli_close($con);

?>