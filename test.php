<?php

echo date("m_d_y",strtotime('-1 days'));

	$apiKey = '2603f74f-b3b4-3ca9-7b5a-00000648c8df';
$foxURL = "http://map.foxtraxgps.com/service/v1.0/device-history";
echo $foxURL."?api_key=".$apiKey."&format=json&start=".date('Y-m-d',strtotime('-1 days'))."&end=".date('Y-m-d')."&device-id=39042";
?>