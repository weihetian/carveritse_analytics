<?php
session_start();
$campaignid=$_SESSION['campaign_id'];
echo "<input type='hidden' id='mapscampaignid' value='$campaignid'></input>";
?>

	<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-location-arrow fa-lg"></i>Locations</div>
  <div class="panel-body">
 	
    <div id="map-canvas" style='box-shadow: 0px 1px 5px #888888;'></div>
  </div>
</div>



 <script>

   var drivermap = [];
   var mapindex = 0;
function getRandomRolor() {
    var letters = '0123456789'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.round(Math.random() * 10)];
    }
    return color;
}

$(document).ready(function() {

var mapscampaignid=$("#mapscampaignid").val();


var url="driversjson.php?id="+mapscampaignid;

var drivers = [];



$.getJSON(url,function(json){
for (var i = 0; i < json.length; i++) { 
	drivers.push({
	name:json[i].drivername,
	info:json[i].info,
	deviceid:json[i].deviceid,
	campaignid:json[i].campaignid,
	front:json[i].front,
	back:json[i].back,
	left:json[i].left,
	right:json[i].right
	
	})
//	var point = [json.features[i].properties.label,json.features[i].geometry.coordinates[1],parseFloat(json.features[i].geometry.coordinates[0])];
//	locations.push(point);}
}

var map;


var locations = [];

var url="report.php";


var markers = Array();


map = new google.maps.Map(document.getElementById('map-canvas'), {
	scrollwheel: false,
    zoom: 9,
    center: new google.maps.LatLng(39.739077, -75.540986),
    mapTypeId: google.maps.MapTypeId.ROADMAP
});




$.getJSON(url,function(json){
//alert();
var o = 0;
	for (var i = 0; i < json.features.length; i++) { 
	
		for(var j = 0;j<drivers.length;j++){
		o++;
			if(json.features[i].properties.deviceId == drivers[j].deviceid){
				var ainfo = drivers[j].info.replace(/\\r\\n/g,  "<br />");
				//alert(ainfo);
				locations.push({
				lon:json.features[i].geometry.coordinates[1],
				lat:json.features[i].geometry.coordinates[0],
				drivername:drivers[j].name,
				pic:drivers[j].left,
				info:ainfo
				})
				
			}
		
		}
	
	
//	var point = [json.features[i].properties.label,json.features[i].geometry.coordinates[1],parseFloat(json.features[i].geometry.coordinates[0])];
	//locations.push(point);
	
  //  alert(json.features[i].geometry.coordinates[0]);
}
			var infowindow = Array();
			

var marker, i;



for (i = 0; i < locations.length; i++) {
  //   marker = new google.maps.Marker({
//         position: new google.maps.LatLng(locations[i].lon, locations[i].lat),
//         map: map
//     });
    markers[i] =  new google.maps.Marker({
        position: new google.maps.LatLng(locations[i].lon, locations[i].lat),
        map: map
    });
	 infowindow[i] = new google.maps.InfoWindow({content:locations[i].drivername+"<br><br><img class='mappic' src='"+locations[i].pic+"'>"});
	 //infowindow.setContent(locations[i][0]);
    google.maps.event.addListener(markers[i], 'mouseover', makeInfoWindowEvent(map, infowindow[i], markers[i]));
     google.maps.event.addListener(markers[i], 'mouseout', closeInfoWindowEvent(map, infowindow[i], markers[i]));
}	
			});


function closeInfoWindowEvent(map, infowindow, marker) {  
   return function() {  
      infowindow.close();
   };  
} 



function makeInfoWindowEvent(map, infowindow, marker) {  
   return function() {  
      infowindow.open(map, marker);
   };  
} 

 setInterval(function(){
 
//alert('done');
 
var url="report.php";
      $.getJSON(url,function(json){
      
      
var locations = [];

//alert();
var o = 0;
	for (var i = 0; i < json.features.length; i++) { 
	
		for(var j = 0;j<drivers.length;j++){
		o++;
			if(json.features[i].properties.deviceId == drivers[j].deviceid){
				var ainfo = drivers[j].info.replace(/\\r\\n/g,  "<br />");
				//alert(ainfo);
				locations.push({
				lon:json.features[i].geometry.coordinates[1],
				lat:json.features[i].geometry.coordinates[0],
				drivername:drivers[j].name,
				info:ainfo
				})
				
			}
		
		}
	
	
//	var point = [json.features[i].properties.label,json.features[i].geometry.coordinates[1],parseFloat(json.features[i].geometry.coordinates[0])];
	//locations.push(point);
	
  //  alert(json.features[i].geometry.coordinates[0]);
}
		


for (i = 0; i < locations.length; i++) {
    var newLatLng = new google.maps.LatLng(locations[i].lon, locations[i].lat);
     markers[i].setPosition(newLatLng);
}	
			});
},1000);



			


});

});
</script>
