<?php
session_start();
$campaignid=$_SESSION['campaign_id'];
echo "<input type='hidden' id='pathscampaignid' value='$campaignid'></input>";
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
  <div class='col-md-9'>
 <div id="tracking" style='box-shadow: 0px 1px 5px #888888;'></div>
 </div>
  <div class='col-md-3'>
 <div id="thedevices" style="height:500px;width:100%;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;"></div>
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


var url="driversjson.php?id="+mapscampaignid;

var drivers = [];
var map ;
function updatemaps(){

var heatdiv = document.getElementById('heat-map');
heatdiv.innerHTML = '<h3>Loading heat map</h3><img src="img/spinner.gif" ></img> ';
	infowindows = {};
  drivermap = {};
  driverselected ={};
    mapindex = 0;
var div = document.getElementById('thedevices');
div.innerHTML ='';
 var url="report.php";
$.getJSON(url,function(json){
var trackinglocations=[];
var flightPath;
var div = document.getElementById('thedevices');
  var mapOptions = {
   
  scrollwheel: false,
    zoom: 9,
    center: new google.maps.LatLng(39.739077, -75.540986),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
map = new google.maps.Map(document.getElementById('tracking'),
      mapOptions);
      
   
      
	for (var i = 0; i < json.features.length; i++) { 
	
	for(var j = 0;j<drivers.length;j++){
		
			if(json.features[i].properties.deviceId == drivers[j].deviceid){
				
	
	div.innerHTML = div.innerHTML + "<div class='checkbox' title='click to see statistics' onmouseover='pathover("+drivers[j].deviceid+")' onmouseout='pathout("+drivers[j].deviceid+")'><label><input type='checkbox' id='checkbox"+drivers[j].deviceid+"' value='' onclick='tracking("+drivers[j].deviceid+")' >"+drivers[j].name+"</label></div>";
//	div.innerHTML = div.innerHTML + " <br>";

        driverselected[drivers[j].deviceid] = false;
mapindex++;


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


var url="devicedate.php?id="+drivers[j].deviceid+"&start="+startdate+"&end="+enddate;
//alert(url);
$.getJSON(url,function(json){
	var sum = Math.round(json.mile/1.60934);
	var sum2 = json.impression;
	var carid = json.carid;
	json = json.path;
	for (var i = 0; i < json.features.length; i++) { 
	var point =  new google.maps.LatLng(json.features[i].geometry.coordinates[1],parseFloat(json.features[i].geometry.coordinates[0]));
	trackinglocations.push(point);
	
  //  alert(json.features[i].geometry.coordinates[0]);
}

var color =getRandomColor();

	
  var polyline = new google.maps.Polyline({
    path: trackinglocations,
    geodesic: true,
    strokeColor: "#6199AE",
    strokeOpacity: 1,
    strokeWeight: 3,
    map:map
  });
  
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
              infowindow.setContent("<br>Total Mile: "+Math.round(sum) +"<br>"+"Total Impression: "+Math.round(sum2));
        
        
        
        infowindow.setPosition(bounds.getCenter());
        //infowindow.open(map);
        drivermap[carid] = polyline;
        infowindows[carid] = infowindow;
	//infowindows.push(infowindow);

// = flightPath;

});

			}
		
		}
	}
	
  //  alert(json.features[i].geometry.coordinates[0]);

 });
 
 
 var mapscampaignid=$("#pathscampaignid").val();
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
 
 var url="alldevicesdate.php?id="+mapscampaignid+"&start="+startdate+"&end="+enddate;
//var hmap, pointarray, heatmap;
var taxiData = new Array();
$.getJSON(url,function(json){
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
 var url="report.php";
$.getJSON(url,function(json){
var trackinglocations=[];
var flightPath;
var div = document.getElementById('thedevices');
  var mapOptions = {
   
  scrollwheel: false,
    zoom: 9,

    center: new google.maps.LatLng( 39.88, -75.25),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
map= new google.maps.Map(document.getElementById('tracking'),
      mapOptions);
      
   
      
	for (var i = 0; i < json.features.length; i++) { 
	
	for(var j = 0;j<drivers.length;j++){
			
			if(json.features[i].properties.deviceId == drivers[j].deviceid){
			
	
//alert(drivers[j].deviceid);
	div.innerHTML = div.innerHTML + "<div class='checkbox' title='click to see statistics' onmouseover='pathover("+drivers[j].deviceid+")' onmouseout='pathout("+drivers[j].deviceid+")'><label><input type='checkbox' id='checkbox"+drivers[j].deviceid+"' value='' onclick='tracking("+drivers[j].deviceid+")' >"+drivers[j].name+"</label></div>";
//	div.innerHTML = div.innerHTML + " <br>";

  driverselected[drivers[j].deviceid]= false;
mapindex++;
		
		
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

var deviceid = drivers[j].deviceid;

var url="devicedate.php?id="+drivers[j].deviceid+"&start="+startdate+"&end="+enddate;
var url2 = "singledevicedate.php?id="+drivers[j].deviceid+"&start="+startdate+"&end="+enddate;
//alert(url);

$.getJSON(url,function(json){
	var sum = Math.round(json.mile/1.60934);
	var sum2 = json.impression;
	var carid=json.carid;
//alert();

	json = json.path;
	for (var i = 0; i < json.features.length; i++) { 
	var point =  new google.maps.LatLng(json.features[i].geometry.coordinates[1],parseFloat(json.features[i].geometry.coordinates[0]));
	trackinglocations.push(point);
	
  //  alert(json.features[i].geometry.coordinates[0]);
}

var color =getRandomColor();

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
        //infowindow.open(map);
        infowindows[carid]=infowindow;
        drivermap[carid]=polyline;
	//infowindows.push(infowindow);
	
 // drivermap.push(polyline);
  
  		

// = flightPath;


});

			}
		
		}
	}
	
  //  alert(json.features[i].geometry.coordinates[0]);
});


var mapscampaignid=$("#pathscampaignid").val();
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
 
 var url="alldevicesdate.php?id="+mapscampaignid+"&start="+startdate+"&end="+enddate;

var hmap, pointarray, heatmap;
var taxiData = new Array();
$.getJSON(url,function(json){
	
for (var i = 0; i < json.length; i++) { 
	var point = {location: new google.maps.LatLng(json[i].geometry.coordinates[1],parseFloat(json[i].geometry.coordinates[0])), weight: 3};
	taxiData.push(point);
	
	
	}

  var mapOptions = {
  scrollwheel: false,
    zoom: 9,

    center: new google.maps.LatLng( 39.88, -75.25),
    
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

 }
 
 );
 
 function pathover(id){
drivermap[id].setOptions({strokeWeight: 5,strokeColor:'#004059', zIndex: 100  });
if(drivermap[id].strokeOpacity==1 && !infowindows[id].opened){
//infowindows[id].open(map);
}
}

function pathout(id)
{
if(!driverselected[id]){
drivermap[id].setOptions({strokeWeight: 3,strokeColor:'#6199AE', zIndex: 1});}
//infowindows[id].close();
}

function tracking(id){
if(document.getElementById('checkbox'+id).checked)
{	driverselected[id]=true;
	
drivermap[id].setOptions({strokeWeight: 5,strokeColor:'#004059', zIndex: 100  });
	infowindows[id].open(map);
  //  drivermap[id].setOptions({strokeOpacity:1});
    }
  else
  {driverselected[id]=false;
	
drivermap[id].setOptions({strokeWeight: 3,strokeColor:'#6199AE', zIndex: 1});
	infowindows[id].close();
    }
}
 
 </script>