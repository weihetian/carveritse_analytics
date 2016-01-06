  
  <div class="panel panel-default">
  <div class="panel-heading"><h3>Current Locations</h3></div>
  <div class="panel-body">
 <div id="map-canvas"></div>
 </div>
 </div>
 <div class="panel panel-default">
  <div class="panel-heading"><h3>Path</h3></div>
  <div class="panel-body">
  <div class='col-md-9'>
 <div id="tracking"></div>
 </div>
  <div class='col-md-3'>
 <div class='citylist' id="thedevices" style="height:500px;width:100%;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;"></div>
 </div>
 </div>
 </div>
  <div class="panel panel-default">
  <div class="panel-heading"><h3>Heat map</h3></div>
  <div class="panel-body">
  <div id="heat-map"><h1>Loading heat map</h1><img src="img/spinner.gif" ></img> </div>
	</div>
	</div>
  </body>  
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
	var div = document.getElementById('thedevices');

	div.innerHTML = div.innerHTML + "device:"+"<a href='javascript:void(0)' onclick='tracking("+json.features[i].properties.deviceId+")'>"+json.features[i].properties.label+"</a>";
	div.innerHTML = div.innerHTML + " <br>";
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

var url="device.php?id="+"40058";

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