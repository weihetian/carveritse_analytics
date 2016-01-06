<?php
$json = file_get_contents('http://map.foxtraxgps.com/service/v1.0/latest-points/list?api_key=2603f74f-b3b4-3ca9-7b5a-00000648c8df&format=json');
$obj = json_decode($json);
$result=array();

foreach($obj->features as $item)
{
//echo $item->properties->deviceId;
$ajson = file_get_contents('http://map.foxtraxgps.com/service/v1.0/device-history?device-id='.$item->properties->deviceId.'&start=1daysago&format=json&api_key=2603f74f-b3b4-3ca9-7b5a-00000648c8df');
$aobj = json_decode($ajson);
if (is_array($aobj->features))
{
foreach($aobj->features as $aitem){
$result[]=$aitem;}
}}
echo json_encode($result);
?>