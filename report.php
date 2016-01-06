<?php

		
$json = file_get_contents('http://map.foxtraxgps.com/service/v1.0/latest-points/list?api_key=2603f74f-b3b4-3ca9-7b5a-00000648c8df&format=json');
echo $json;

?>