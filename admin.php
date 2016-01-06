<!-- 
<?php
	session_start();
   //Read your session (if it is set)
   if (isset($_SESSION['admin']))
	{
      if( $_SESSION['admin']!="admin")
	  {
	  header('Location: login.html');
	  }
	  }else
	  {
	  header('Location: login.html');
	  }
	  
	 $con=mysqli_connect('mysql.stak.co', 'scott_tian','87565342','briannasite');

		// Check connection
		if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
 ?>
 -->
 

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <title>admin</title>
	<link href="css/_admin.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
	     
        
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

        
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=visualization"></script>
        <script type="text/javascript">
            // When the window has finished loading create our google map below
         
        </script>
        
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>
<body>
<div class="main">
	<div class="container">
		<div class="page-header">
			<h1>Carvertise<a class="btn pull-right btn-primary" href="sign_out.php">Sign out</a></h1>
			
		</div> 
<h1>Current Locations</h1>
 <div id="map-canvas"></div>
 <h1>Path</h1>
 <div id="devices"></div>
 <div id="tracking"></div>
 <h1>Heat map</h1>
  <div id="heat-map"><h1>Loading heat map</h1><img src="img/spinner.gif" ></img> </div>
 
	</div>
 
</div>
<script type="text/javascript">

var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;


var locations =  new Array();

var url="report.php";

$.getJSON(url,function(json){

	for (var i = 0; i < json.features.length; i++) { 
	var point = [json.features[i].properties.label,json.features[i].geometry.coordinates[1],parseFloat(json.features[i].geometry.coordinates[0])];
	locations.push(point);
	
  //  alert(json.features[i].geometry.coordinates[0]);
}
			var infowindow = Array();

var marker, i;

map = new google.maps.Map(document.getElementById('map-canvas'), {
    zoom: 10,
    center: new google.maps.LatLng(39.739077, -75.540986),
    mapTypeId: google.maps.MapTypeId.ROADMAP
});

for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
    });
	 infowindow[i] = new google.maps.InfoWindow({content: locations[i][0]});
	 //infowindow.setContent(locations[i][0]);
    google.maps.event.addListener(marker, 'click', makeInfoWindowEvent(map, infowindow[i], marker));
}
			
			
			});

function makeInfoWindowEvent(map, infowindow, marker) {  
   return function() {  
      infowindow.open(map, marker);
   };  
} 



</script>

<script type="text/javascript">

var url="report.php";
$.getJSON(url,function(json){

	for (var i = 0; i < json.features.length; i++) { 
	var div = document.getElementById('devices');

	div.innerHTML = div.innerHTML + "device:"+"<a href='javascript:void(0)' onclick='tracking("+json.features[i].properties.deviceId+")'>"+json.features[i].properties.label+"</a>";
	div.innerHTML = div.innerHTML + "  ";
	}
  //  alert(json.features[i].geometry.coordinates[0]);
})

</script>


<script type="text/javascript">
var url="alldevices.php";
var map, pointarray, heatmap;
var taxiData = new Array();
$.getJSON(url,function(json){
for (var i = 0; i < json.length; i++) { 
	var point =  new google.maps.LatLng(json[i].geometry.coordinates[1],parseFloat(json[i].geometry.coordinates[0]));
	taxiData.push(point);
	
	
	}

  var mapOptions = {
    zoom: 10,
    center: new google.maps.LatLng(39.739077, -75.540986),
    
  mapTypeId: google.maps.MapTypeId.HYBRID
  };

  map = new google.maps.Map(document.getElementById('heat-map'),
      mapOptions);

  var pointArray = new google.maps.MVCArray(taxiData);
  heatmap = new google.maps.visualization.HeatmapLayer({
    data: pointArray
  });

  heatmap.setMap(map);


});

</script>




<script type="text/javascript">


var trackinglocations =  new Array();

var url="device.php?id="+"37797";

$.getJSON(url,function(json){

	for (var i = 0; i < json.features.length; i++) { 
	var point =  new google.maps.LatLng(json.features[i].geometry.coordinates[1],parseFloat(json.features[i].geometry.coordinates[0]));
	trackinglocations.push(point);
	
  //  alert(json.features[i].geometry.coordinates[0]);
}
  var mapOptions = {
    zoom: 10,
    center: new google.maps.LatLng(39.739077, -75.540986),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  var map = new google.maps.Map(document.getElementById('tracking'),
      mapOptions);

  var flightPlanCoordinates = [
    new google.maps.LatLng(37.772323, -122.214897),
    new google.maps.LatLng(21.291982, -157.821856),
    new google.maps.LatLng(-18.142599, 178.431),
    new google.maps.LatLng(-27.46758, 153.027892)
  ];
  var flightPath = new google.maps.Polyline({
    path: trackinglocations,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  flightPath.setMap(map);


});



</script>

<script type="text/javascript">
function tracking(id){
var trackinglocations =  new Array();

var url="device.php?id="+id;

$.getJSON(url,function(json){

	for (var i = 0; i < json.features.length; i++) { 
	var point =  new google.maps.LatLng(json.features[i].geometry.coordinates[1],parseFloat(json.features[i].geometry.coordinates[0]));
	trackinglocations.push(point);
	
  //  alert(json.features[i].geometry.coordinates[0]);
}
  var mapOptions = {
    zoom: 10,
    center: new google.maps.LatLng(39.739077, -75.540986),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  var map = new google.maps.Map(document.getElementById('tracking'),
      mapOptions);

  var flightPlanCoordinates = [
    new google.maps.LatLng(37.772323, -122.214897),
    new google.maps.LatLng(21.291982, -157.821856),
    new google.maps.LatLng(-18.142599, 178.431),
    new google.maps.LatLng(-27.46758, 153.027892)
  ];
  var flightPath = new google.maps.Polyline({
    path: trackinglocations,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  flightPath.setMap(map);


});

}

</script>


</body>


</html>