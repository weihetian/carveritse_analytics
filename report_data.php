<?php



$id=$_GET['id'];

$start=date('Y-m-d', strtotime($_GET['start']));
$end=date('Y-m-d', strtotime($_GET['end']));

$json = file_get_contents('http://map.foxtraxgps.com/service/v1.0/device-history?device-id='.$id.'&start='.$start.'&end='.$end.'&format=json&api_key=2603f74f-b3b4-3ca9-7b5a-00000648c8df');
echo $json;
?>