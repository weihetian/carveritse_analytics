<?php
session_start();
$campaignid=$_SESSION['campaign_id'];
$deviceid=$_SESSION['deviceid'];
echo "<input type='hidden' id='pathscampaignid' value='$campaignid'></input>
<input type='hidden' id='pathcampaigndeviceid' value='$deviceid'></input>";

$campaignstart =$_SESSION['campaign_date'];
echo "<input type='hidden' id='campaignstart' value='$campaignstart'></input>";
?>

 <div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-car fa-lg"></i>Path
  <h4>Date  <i class="fa fa-calendar"></i>
  <button class='btn btn-sm btn-default' onclick ='dateleft()'><i class="fa fa-caret-left fa-lg"></i></button>
 <input type="text" name="start" id="pathdatepicker" ></input> 
 <button class='btn btn-sm btn-default' onclick ='dateright()'><i class="fa fa-caret-right fa-lg"></i></button>

</h4>
  </div>
  <div class="panel-body">
  <div class='col-md-12'>
 <div id="tracking" style='box-shadow: 0px 1px 5px #888888;'></div>
 </div>
  
 </div>
 </div>
 
   <div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-sun-o fa-lg"></i>Heat map</div>
  <div class="panel-body">
  <div id="heat-map" style='box-shadow: 0px 1px 5px #888888;'><h3>Loading heat map</h3><img src="img/spinner.gif" ></img> </div>
	</div>
	</div>
 
 <script>
    $(function() {
	
    	var cid = $('#campaignstart').val();
    	var date = new Date(cid);
    	var day = date.getDate()+1;
    	  var month = date.getMonth();
    	  var year = date.getFullYear();
       $( "#pathdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy'}).datepicker("setDate", new Date(year,month,day));
     });
 
function dateleft(){
	var current = $( "#pathdatepicker" ).datepicker( "getDate" );
	  current.setDate(current.getDate()-1); 
	 $( "#pathdatepicker" ).datepicker("setDate", current);
	 updatemaps();
} 

function dateright()
{
	var current = $( "#pathdatepicker" ).datepicker( "getDate" );
	var d = new Date();
	
	if(current.getMonth()==d.getMonth() && current.getDate() < d.getDate()-1){
	  current.setDate(current.getDate()+1); 
 $( "#pathdatepicker" ).datepicker("setDate", current);
 updatemaps();
 }else if(current.getMonth()<d.getMonth() ){
	  current.setDate(current.getDate()+1); 
 $( "#pathdatepicker" ).datepicker("setDate", current);
 updatemaps();
 }
}

$('#pathdatepicker').datepicker().change(function() {
     updatemaps();
});

 var drivermap = {};
 var infowindows = {};

 var driverselected ={};
   var mapindex = 0;
 var mapscampaignid=$("#pathscampaignid").val();
 

// 
// var url="driversjson.php?id="+mapscampaignid;
// 
// var drivers = [];
 var map ;
 
 function updatemaps(){
 var heatdiv = document.getElementById('heat-map');
heatdiv.innerHTML = '<h3>Loading heat map</h3><img src="img/spinner.gif" ></img> ';
 var drivermap = {};
 var infowindows = {};

 var driverselected ={};
 
 var trackinglocations=[];
var flightPath;

var mapOptions = {
   
  scrollwheel: false,
    zoom: 9,
    center: new google.maps.LatLng(39.739077, -75.540986),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
map= new google.maps.Map(document.getElementById('tracking'),
      mapOptions);
      
 var deviceid=$("#pathcampaigndeviceid").val();      

 var start = $( "#pathdatepicker" ).datepicker( "getDate" );
var starty = start.getFullYear();

var startm = start.getMonth()+1;
if(startm <10){
	startm = "0"+startm;

}

var startd = start.getDate();
if(startd <10){
	stard = "0"+startd;
}

start.setDate(start.getDate()+1);
var endy = start.getFullYear();

var endm = start.getMonth()+1;
if(endm <10){
	endm = "0"+endm;

}

var endd = start.getDate();
if(endd <10){
	endd = "0"+endd;
}
var startdate = starty+"-"+startm+"-"+startd;

var enddate = endy+"-"+endm+"-"+endd;



var url="devicedate.php?id="+deviceid+"&start="+startdate+"&end="+enddate;

$.getJSON(url,function(json){
	var sum = Math.round(json.mile/1.60934);
	var sum2 = json.impression;
	var carid=json.carid;
	
	json = json.path;
	for (var i = 0; i < json.features.length; i++) { 
	var point =  new google.maps.LatLng(json.features[i].geometry.coordinates[1],parseFloat(json.features[i].geometry.coordinates[0]));
	trackinglocations.push(point);
	
}


	var polyline = new google.maps.Polyline({
    path: trackinglocations,
    geodesic: true,
    strokeColor: "#6199AE",
    strokeOpacity: 1,
    strokeWeight: 3,
    map:map
  })
  
   var bounds = new google.maps.LatLngBounds();
for (var i = 0; i < trackinglocations.length; i++) {
    bounds.extend(trackinglocations[i]);
}
trackinglocations=[];


  
  		var infowindow = new google.maps.InfoWindow(
  		{
  		
      disableAutoPan: true
  		});
  		if(sum2==0){
  			sum2 = "no data";
  			}
        infowindow.setContent("Total Mile: "+Math.round(sum) +"<br>"+"Total Impression: "+Math.round(sum2));
        
        
        infowindow.setPosition(bounds.getCenter());
        infowindow.open(map);
       // infowindows[carid]=infowindow;
       // drivermap[carid]=polyline;
	//infowindows.push(infowindow);
	
 // drivermap.push(polyline);
  
  		

// = flightPath;


});



var mapscampaignid=$("#pathscampaignid").val();
 var start = $( "#pathdatepicker" ).datepicker( "getDate" );

      
 var deviceid=$("#pathcampaigndeviceid").val();      


var starty = start.getFullYear();

var startm = start.getMonth()+1;
if(startm <10){
	startm = "0"+startm;

}

var startd = start.getDate();
if(startd <10){
	stard = "0"+startd;
}

start.setDate(start.getDate()+1);
var endy = start.getFullYear();

var endm = start.getMonth()+1;
if(endm <10){
	endm = "0"+endm;

}

var endd = start.getDate();
if(endd <10){
	endd = "0"+endd;
}

var startdate = starty+"-"+startm+"-"+startd;

var enddate = endy+"-"+endm+"-"+endd;
 
var url="devicedate.php?id="+deviceid+"&start="+startdate+"&end="+enddate;


var hmap, pointarray, heatmap;
var taxiData = new Array();
$.getJSON(url,function(json){
	json = json.path.features;
	//alert(json);
for (var i = 0; i < json.length; i++) { 
	var point =  new google.maps.LatLng(json[i].geometry.coordinates[1],parseFloat(json[i].geometry.coordinates[0]));
	taxiData.push(point);
	
	
	}

  var mapOptions = {
  scrollwheel: false,
    zoom: 9,
    center: new google.maps.LatLng(39.739077, -75.540986),
    
  mapTypeId: google.maps.MapTypeId.HYBRID
  };

  hmap = new google.maps.Map(document.getElementById('heat-map'),
      mapOptions);

  var pointArray = new google.maps.MVCArray(taxiData);
  heatmap = new google.maps.visualization.HeatmapLayer({
    data: pointArray
  });

  heatmap.setMap(hmap);


});
 }
 


//update end


  
$(document).ready(function() {
var trackinglocations=[];
var flightPath;

var mapOptions = {
   
  scrollwheel: false,
    zoom: 9,
    center: new google.maps.LatLng(39.739077, -75.540986),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
map= new google.maps.Map(document.getElementById('tracking'),
      mapOptions);
      
 var deviceid=$("#pathcampaigndeviceid").val();      

 var start = $( "#pathdatepicker" ).datepicker( "getDate" );
var starty = start.getFullYear();

var startm = start.getMonth()+1;
if(startm <10){
	startm = "0"+startm;

}

var startd = start.getDate();
if(startd <10){
	stard = "0"+startd;
}

start.setDate(start.getDate()+1);
var endy = start.getFullYear();

var endm = start.getMonth()+1;
if(endm <10){
	endm = "0"+endm;

}

var endd = start.getDate();
if(endd <10){
	endd = "0"+endd;
}
var startdate = starty+"-"+startm+"-"+startd;

var enddate = endy+"-"+endm+"-"+endd;



var url="devicedate.php?id="+deviceid+"&start="+startdate+"&end="+enddate;

$.getJSON(url,function(json){
	var sum = Math.round(json.mile/1.60934);
	var sum2 = json.impression;
	var carid=json.carid;
	
	json = json.path;
	for (var i = 0; i < json.features.length; i++) { 
	var point =  new google.maps.LatLng(json.features[i].geometry.coordinates[1],parseFloat(json.features[i].geometry.coordinates[0]));
	trackinglocations.push(point);
	
}


	var polyline = new google.maps.Polyline({
    path: trackinglocations,
    geodesic: true,
    strokeColor: "#6199AE",
    strokeOpacity: 1,
    strokeWeight: 3,
    map:map
  })
  
   var bounds = new google.maps.LatLngBounds();
for (var i = 0; i < trackinglocations.length; i++) {
    bounds.extend(trackinglocations[i]);
}
trackinglocations=[];


  
  		var infowindow = new google.maps.InfoWindow(
  		{
  		
      disableAutoPan: true
  		});
  		if(sum2==0){
  			sum2 = "no data";
  			}
        infowindow.setContent("Total Mile: "+Math.round(sum) +"<br>"+"Total Impression: "+Math.round(sum2));
        
        
        infowindow.setPosition(bounds.getCenter());
        infowindow.open(map);
       // infowindows[carid]=infowindow;
       // drivermap[carid]=polyline;
	//infowindows.push(infowindow);
	
 // drivermap.push(polyline);
  
  		

// = flightPath;


});



var mapscampaignid=$("#pathscampaignid").val();
 var start = $( "#pathdatepicker" ).datepicker( "getDate" );

      
 var deviceid=$("#pathcampaigndeviceid").val();      


var starty = start.getFullYear();

var startm = start.getMonth()+1;
if(startm <10){
	startm = "0"+startm;

}

var startd = start.getDate();
if(startd <10){
	stard = "0"+startd;
}

start.setDate(start.getDate()+1);
var endy = start.getFullYear();

var endm = start.getMonth()+1;
if(endm <10){
	endm = "0"+endm;

}

var endd = start.getDate();
if(endd <10){
	endd = "0"+endd;
}

var startdate = starty+"-"+startm+"-"+startd;

var enddate = endy+"-"+endm+"-"+endd;
 
var url="devicedate.php?id="+deviceid+"&start="+startdate+"&end="+enddate;


var hmap, pointarray, heatmap;
var taxiData = new Array();
$.getJSON(url,function(json){
	json = json.path.features;
	//alert(json);
for (var i = 0; i < json.length; i++) { 
	var point =  new google.maps.LatLng(json[i].geometry.coordinates[1],parseFloat(json[i].geometry.coordinates[0]));
	taxiData.push(point);
	
	
	}

  var mapOptions = {
  scrollwheel: false,
    zoom: 9,
    center: new google.maps.LatLng(39.739077, -75.540986),
    
  mapTypeId: google.maps.MapTypeId.HYBRID
  };

  hmap = new google.maps.Map(document.getElementById('heat-map'),
      mapOptions);

  var pointArray = new google.maps.MVCArray(taxiData);
  heatmap = new google.maps.visualization.HeatmapLayer({
    data: pointArray
  });

  heatmap.setMap(hmap);


});
});

  

 
 </script>