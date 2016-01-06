<html>
<head>

	 <link href="css/bootstrap.min.css" rel="stylesheet">
	 
        <script src="js/Chart.js"></script>
</head>

<body>

<div class="main">
	<div class="container">
			<div class="page-header">
			<h1>Report Builder</h1>
			
			</div> 
			<div class='row'>
			<form role="form" class='col-md-6'>
 		
				<div class="form-group">
			<label for="startdatepicker">Time Interval</label>
				    
			<p>Start <input type="text" name="start" id="startdatepicker">  End <input type="text" name="end" id="enddatepicker">
			</div>
			<button type='button' class='btn btn-primary' onclick='build()'>Submit</button>
			</form>
			</div>
			<br>
			<div class='row'>
				<h1>Result</h1>
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
$(function() {
    $( "#startdatepicker" ).datepicker();
  });$(function() {
    $( "#enddatepicker" ).datepicker();
  });
 // var deviceids =['43912','40059','43375'];

  
// Jennifer 19 48268
// jERRY 19 48271
// Dawn 19 48273
//
// Terree 18 47208 
 
// Peggy 48663
// Bernard Johnson 48666
// Rebecca Gaunt 48665
// Rob White 48669
// Honorae 48662
// Jamal 48668
//
// David Demuez 07-05 48274
  
 var deviceids =['47207','47697','47204','47211','47203','47195','47198','47199','47197','47212','47205','47194','47201','47193','47202','47196','47206','47200','47210','47209'];
 
   // var deviceids =['48268','48271','48273','47208'];
     var j = 0;
// 40063
// 48273!
// 43912
// 40059
// 43375
  function build(){
  if(j<20){
//var deviceids = ['39043','40058','39051','40063','39045','41027','39042','35602','35603','40066','39049','41023','37797','39048','40059','37479','40417','39046','41026','37475','40062','39050','40068','40067','41021','39047','40064'];
 document.getElementById("report").innerHTML+="<br>Start!";
//for (var j = 0;j<deviceids.length;j++){
var deviceid =deviceids[j];

document.getElementById("report").innerHTML+="<br>deviceid: "+deviceid;
var startdatepicker = $("#startdatepicker").val();
var enddatepicker = $("#enddatepicker").val();
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
$.ajax({
    type: "POST",
     url: "store_mile_report.php",
     
    data: {myData:JSON.stringify(milereport)},
    success: function(data){
    
document.getElementById("report").innerHTML+="<br>Stored!!";
j++;
build();
   //	 var cities  = JSON.parse(data);
   	 //	alert("good");
    	//document.getElementById("report").innerHTML+="<br>This is the reuslt"+cities;
    },
        error: function(e){
            document.getElementById("report").innerHTML+=e.message;
        }
        });
    
     var keys = [];
     var values = [];
for(var k in finalresult){
keys.push(k);
values.push(finalresult[k]);
}

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

document.getElementById("report").innerHTML+="<br>------------------------------<br>"+$("#startdatepicker").val();
}
}

</script>

	<script>
	function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function shadeColor1(color, percent) {  
    var num = parseInt(color,16),
    amt = Math.round(2.55 * percent),
    R = (num >> 16) + amt,
    G = (num >> 8 & 0x00FF) + amt,
    B = (num & 0x0000FF) + amt;
    return (0x1000000 + (R<255?R<1?0:R:255)*0x10000 + (G<255?G<1?0:G:255)*0x100 + (B<255?B<1?0:B:255)).toString(16).slice(1);
}

function shadeColor2(color, percent) {   
    var f=parseInt(color.slice(1),16),t=percent<0?0:255,p=percent<0?percent*-1:percent,R=f>>16,G=f>>8&0x00FF,B=f&0x0000FF;
    return "#"+(0x1000000+(Math.round((t-R)*p)+R)*0x10000+(Math.round((t-G)*p)+G)*0x100+(Math.round((t-B)*p)+B)).toString(16).slice(1);
}
	
            //Get the context of the canvas element we want to select
        
	</script>



	<script>
	
	
            //Get the context of the canvas element we want to select
         

	</script>
</body>


</html>