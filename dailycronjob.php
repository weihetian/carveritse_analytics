<html>
<head>

	 <link href="css/bootstrap.min.css" rel="stylesheet">
	 
</head>

<body>

<div class="main">
	<div class="container">
			<div class="page-header">
			<h1>Report Builder</h1>
			
			</div> 
			<br>
			<div class='row'>
				<h2>Result</h2>
				<div id='report'>
			
				</div>
				
		
		
			</div>
	</div>
</div>

  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	    <script  type="text/javascript" src="js/_datasource.js"></script>
	    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry"></script>
	
	
<script src="js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
	 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
	    <script  type="text/javascript" src="js/_datasource.js"></script>
	    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry"></script>

<script type='text/javascript'>

var deviceids = ['39043','40058','39051','40063','39045','41027','39042','35602','35603','40066','39049','41023','37797','39048','40059','37479','40417','39046','41026','37475','40062','39050','40068','40067','41021','39047','40064'];
var j = 0;
var startdate;
var enddate;

$(function(){
$.get( "dailycron.php", function( data ) {
  if(data=="go"){
  var today = new Date();
var dd = today.getDate();
var yd = dd-1;
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();



if(dd<10) {
    dd='0'+dd
} 


if(mm<10) {
    mm='0'+mm
} 
var yesterday = mm+'/'+yd+'/'+yyyy;
today = mm+'/'+dd+'/'+yyyy;
startdate = yesterday;
enddate=today;

  //alert( "lets do it from "+startdate + " to "+enddate );
  
  build();
  }else{
  document.getElementById("report").innerHTML+="DONE!!!";
  }
});

});

function build(){
if(j<27){
//var deviceids = ['39043','40058','39051','40063','39045','41027','39042','35602','35603','40066','39049','41023','37797','39048','40059','37479','40417','39046','41026','37475','40062','39050','40068','40067','41021','39047','40064'];
 document.getElementById("report").innerHTML+="<br>Start!";
//for (var j = 0;j<deviceids.length;j++){
var deviceid =deviceids[j];

document.getElementById("report").innerHTML+="<br>deviceid: "+deviceid;
var startdatepicker =startdate;
var enddatepicker = enddate;
var content = '';
var url="report_data.php?id="+deviceid+"&start="+startdatepicker+"&end="+enddatepicker;
$.getJSON(url,function(json){
if(json.hasOwnProperty('features')){
var index = 0;
var coordinates = Array();
var distancearray = Array();
var thispoint;
var lastpoint;
var total=0;
var locdis = Array();
lastpoint = new google.maps.LatLng(json.features[0].geometry.coordinates[1],json.features[0].geometry.coordinates[0]);

for (var i = 0; i < json.features.length; i++) {

coordinates.push([json.features[i].geometry.coordinates[1],json.features[i].geometry.coordinates[0]]);



//var mile= total * 0.000621371;

}

       //      for(var i = 0; i < distancearray.length; i++){
//             //document.getElementById("report").innerHTML+=cities[i];
//             
//             document.getElementById("report").innerHTML+="  distance:";
//              document.getElementById("report").innerHTML+=distancearray[i];
//             document.getElementById("report").innerHTML+="<br>";
//             }

var myJsonString = JSON.stringify(coordinates);
document.getElementById("report").innerHTML+="<br>Got coordinates";
//document.getElementById("report").innerHTML+=myJsonString;
$.ajax({
    type: "POST",
     url: "zippicker.php",
     
    data: {myData:JSON.stringify(coordinates) },
    success: function(data){
    document.getElementById("report").innerHTML+="<br>Got zips ";
  //  document.getElementById("report").innerHTML='';
 var cities  = JSON.parse(data);
//             for(var i = 0; i < cities.length; i++){
//             document.getElementById("report").innerHTML+=cities[i];
//             
//             document.getElementById("report").innerHTML+="  index:"+i;
//           //   document.getElementById("report").innerHTML+=distancearray[i];
//             document.getElementById("report").innerHTML+="<br>";
//             }
//             document.getElementById("report").innerHTML+="DONE";


for (var i = 0; i < json.features.length; i++)
	{
	
	
	thispoint = new google.maps.LatLng(json.features[i].geometry.coordinates[1],json.features[i].geometry.coordinates[0]);
distancearray.push(google.maps.geometry.spherical.computeDistanceBetween (thispoint, lastpoint)* 0.000621371);
total+=google.maps.geometry.spherical.computeDistanceBetween (thispoint, lastpoint)* 0.000621371;
lastpoint = new google.maps.LatLng(json.features[i].geometry.coordinates[1],json.features[i].geometry.coordinates[0]);
}

for(var i = 0;i<cities.length;i++){
locdis.push([cities[i],distancearray[i]]);
}
//for(var i = 0;i<locdis.length;i++){
//document.getElementById("report").innerHTML+="City:"+locdis[i][0]+"---------"+" Distance:"+locdis[i][1]+"miles<br>";}
//document.getElementById("report").innerHTML+="<br><br>--------------------------------------------------------<br><br>";

var arealast;
var areacurrent;
var finalresult = {};

arealast = locdis[0][0];
areacurrent=locdis[0][0];
//document.getElementById("report").innerHTML+="<br>";
for(var i = 0;i<locdis.length;i++){
	areacurrent = locdis[i][0];
	if(arealast == areacurrent){
		
		if(areacurrent in finalresult){
			finalresult[areacurrent]+= locdis[i][1];
		}else
		{
			finalresult[areacurrent]= locdis[i][1];
		}
	}else
	{
		if(areacurrent in finalresult){
			finalresult[areacurrent]+= locdis[i][1];
		}else
		{
			finalresult[areacurrent]= locdis[i][1];
		}
	}
	arealast=locdis[i][0];
}

// for (var key in finalresult) {
//         if (finalresult.hasOwnProperty(key)) {
//         	document.getElementById("report").innerHTML+="City:"+key +"---------"+" Distance:"+finalresult[key]+"miles<br>";
// 
//         }
//     }

var milereport = {
report:finalresult,
thedate:startdatepicker,
deviceid:deviceid
};


//document.getElementById("report").innerHTML+=JSON.stringify(milereport);
//alert(milereport);
// $.ajax({
//     type: "POST",
//      url: "store_mile_report.php",
//      
//     data: {myData:JSON.stringify(milereport)},
//     success: function(data){
//     
// document.getElementById("report").innerHTML+="<br>Stored!!";
// j++;
// build();
//    //	 var cities  = JSON.parse(data);
//    	 //	alert("good");
//     	//document.getElementById("report").innerHTML+="<br>This is the reuslt"+cities;
//     },
//         error: function(e){
//             document.getElementById("report").innerHTML+=e.message;
//         }
//         });
    j++;
build();
//      var keys = [];
//      var values = [];
// for(var k in finalresult){
// keys.push(k);
// values.push(finalresult[k]);
// }

// for(var i = 0;i<keys.length;i++){
// 	document.getElementById("report").innerHTML+=keys[i];
// 	document.getElementById("report").innerHTML+="<br>";
// }
// 
// for(var i = 0;i<values.length;i++){
// 	document.getElementById("report").innerHTML+=values[i];
// 	document.getElementById("report").innerHTML+="<br>";
// }


// 	var barChartData = {
// 		labels :keys,
// 		datasets : [
// 			{
// 				fillColor : "rgba(220,220,220,0.5)",
// 				strokeColor : "rgba(220,220,220,0.8)",
// 				highlightFill: "rgba(220,220,220,0.75)",
// 				highlightStroke: "rgba(220,220,220,1)",
// 				data : values
// 			}
// 		]
// 
// 	}
//             
// 		var ctx = document.getElementById("barChart").getContext("2d");
// 		options = {
//                 barDatasetSpacing : 15,
//                 barValueSpacing: 10
//             };
// 		
// 		new Chart(ctx).Bar(barChartData, options);
// 	
// 	
// 	  var ctx = document.getElementById("pieChart").getContext("2d");
//             var color;
//          //   var shade = shadeColor2(color,0.2);
//             //Create the data object to pass to the chart
//             var data=[];
//             for(var i = 0;i<keys.length;i++){
//             
//              data.push({ value: values[i],
// 			        color:color=getRandomColor(),
// 			        highlight: shadeColor2(color,0.3),
// 			        label: keys[i]});
//             }
//             
//             //The options we are going to pass to the chart
//             options = {};
//             
//             //Create the chart
//             new Chart(ctx).Doughnut(data, options);

	
 //                  for(var i = 0; i < distancearray.length; i++){
//             //document.getElementById("report").innerHTML+=cities[i];
//             
//             document.getElementById("report").innerHTML+=i+" distance:";
//              document.getElementById("report").innerHTML+=distancearray[i];
//             document.getElementById("report").innerHTML+="<br>";
//             }
        },
        error: function(e){
            document.getElementById("report").innerHTML+=e.message;
        }


});
}else
{
j++;
build();
}
})

}else
{

document.getElementById("report").innerHTML+="<br>------------------------------<br>"+startdate;
}
}


</body>


</html>