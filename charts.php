<?php
$campaignid=$_GET['id'];
echo "<input type='hidden' id='chartcampaignid' value='$campaignid'></input>";

?>
  <div class="panel panel-default">
   
     <div class="panel-heading">
	<div class='row'>
	<div class='col-md-5'>
	<h1>Miles report</h1>
	</div>
	<div class='col-md-7'>
	
	<h4>Time interval</h4>
	Start <input type="text" name="start" id="thestartdatepicker"> End <input type="text" name="start" id="theenddatepicker"> 
	
	<button class='btn btn-sm btn-default' onclick="changedate()">UPDATE</button>
	
	</div>
	
	
		
	</div>
	</div>
	 <div class="panel-body">
	<div class='row'>
		<div class='col-md-12'>
		<canvas id="lineChart" width="900" height="200"></canvas>
		
		</div>
	</div>
	<br>
	
	<br>
	<div class='row'>
		<div class='col-md-4 col-md-offset-0'>
			
			<canvas id="pieChart" width="300" height="200"></canvas>
		
				<div class='citylist' id='citylist1' style="height:120px;width:100%;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
					
				</div>
		</div>
		<div class='col-md-4 col-md-offset-0'>
			<canvas id="pieChart2" width="300" height="200"></canvas>
			
				<div class='citylist' id='citylist2' style="height:120px;width:100%;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
					
				</div>
		</div>
		<div class='col-md-4 col-md-offset-0'>
		
			<canvas id="pieChart3" width="300" height="200"></canvas>
		
			<div class='citylist' id='citylist3' style="height:120px;width:100%;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
					
				</div>
		</div>
	</div>
	<br>
	<div class='row'>
			<div class='col-md-12'>
		<canvas  id="barChart" width="900" height="400"></canvas>
		
		</div>
		
	</div>
	</div>
	</div>
	
<!-- 
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
	 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
 -->

	
<script>
var linechart;
var piechart1;
var piechart2;
var piechart3;
var barchart;

function changedate(){


linechart.destroy();
piechart1.destroy();
piechart2.destroy();
piechart3.destroy();
barchart.destroy();
 document.getElementById("citylist1").innerHTML="";
  document.getElementById("citylist2").innerHTML="";
   document.getElementById("citylist3").innerHTML="";
   
   var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var campaignid=$("#chartcampaignid").val();

var url="getIntervalMileReport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;
	//alert();
	//alert(url);
	$.getJSON(url,function(json){
	
	var keys = [];
     var values = [];


	 $.each(json, function(k,v) {
            keys.push(k);
            values.push(Math.round(v));
        });
        
        var lineChartData = {
		labels :keys,
		datasets : [
			
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data :  values
			}
		]

	}
            
		var ctx = document.getElementById("lineChart").getContext("2d");
		options = {
               pointDot : true,
               
               bezierCurve : false
            };
		
		linechart = new Chart(ctx).Line(lineChartData, options);
	
	
        
        
        
	});

//alert(startdatepicker);
	var url="getmilereport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;;
	//alert();
	$.getJSON(url,function(json){
//	alert();
	//var keys = [];
   // var values = [];
 //  var cities = Array()
   
//	var finalresult = {};
//    for(var i = 0;i<json.length;i++){
	//areacurrent = json[i][0];
//	cities.push(json[i][0]);
//	}
//	var cities  = JSON.parse(json);
var keys = [];
     var values = [];


	 $.each(json, function(k,v) {
            keys.push(k);
            values.push(Math.round(v));
        });
        
        var finalkeys = keys.slice(0, 10);
        var finalvalues = values.slice(0, 10);
        
         document.getElementById("citylist1").innerHTML+="<ul>";
        for(var i=0; i<finalkeys.length;i++){
        document.getElementById("citylist1").innerHTML+="<li>"+finalkeys[i]+": "+finalvalues[i]+"</li>";
        
        }
         document.getElementById("citylist1").innerHTML+="</ul>";
        
        
        var finalkeys2 = keys.slice(10, 30);
        var finalvalues2 = values.slice(10, 30);
          document.getElementById("citylist2").innerHTML+="<ul>";
        for(var i=0; i<finalkeys2.length;i++){
        document.getElementById("citylist2").innerHTML+="<li>"+finalkeys2[i]+": "+finalvalues2[i]+"</li>";
        
        }
         document.getElementById("citylist2").innerHTML+="</ul>";
        
        
        var finalkeys3 = keys.slice(30, 60);
        var finalvalues3 = values.slice(30, 60);
        
        document.getElementById("citylist3").innerHTML+="<ul>";
        for(var i=0; i<finalkeys3.length;i++){
        document.getElementById("citylist3").innerHTML+="<li>"+finalkeys3[i]+": "+finalvalues3[i]+"</li>";
        
        }
         document.getElementById("citylist3").innerHTML+="</ul>";
        
        var finalkeys4 = keys.slice(0, 15);
        var finalvalues4 = values.slice(0, 15);
        
        
    var barChartData = {
		labels :finalkeys4,
		datasets : [
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill: "rgba(151,187,205,0.75)",
				highlightStroke: "rgba(151,187,205,1)",
				data : finalvalues4
			}
		]

	}
            
		var ctx = document.getElementById("barChart").getContext("2d");
		options = {
                
                datasetStrokeWidth : 1,
                barValueSpacing:7
            };
		
		barchart = new Chart(ctx).Bar(barChartData, options);
		
		  var ctx = document.getElementById("pieChart").getContext("2d");
            var color;
         //   var shade = shadeColor2(color,0.2);
            //Create the data object to pass to the chart
            var data=[];
            for(var i = 0;i<finalkeys.length;i++){
            
             data.push({ value: finalvalues[i],
			        color:"rgba(151,187,205,1)",
			        highlight: "rgba(151,187,205,0.5)",
			        label: finalkeys[i]});
            }
            
            //The options we are going to pass to the chart
            options = {
            scaleShowLabels : true
            };
            
            //Create the chart
           piechart1 =  new Chart(ctx).Doughnut(data, options);
            
             var ctx = document.getElementById("pieChart2").getContext("2d");
            var color;
         //   var shade = shadeColor2(color,0.2);
            //Create the data object to pass to the chart
            var data=[];
            for(var i = 0;i<finalkeys2.length;i++){
            
             data.push({ value: finalvalues2[i],
			        color:"rgba(151,187,205,1)",
			        highlight: "rgba(151,187,205,0.5)",
			        label: finalkeys2[i]});
            }
            
            //The options we are going to pass to the chart
            options = {
            };
            
            //Create the chart
           piechart2 = new Chart(ctx).Doughnut(data, options);
            
            
            
             var ctx = document.getElementById("pieChart3").getContext("2d");
            var color;
         //   var shade = shadeColor2(color,0.2);
            //Create the data object to pass to the chart
            var data=[];
            for(var i = 0;i<finalkeys3.length;i++){
            
             data.push({ value: finalvalues3[i],
			        color:"rgba(151,187,205,1)",
			        highlight: "rgba(151,187,205,0.5)",
			        label: finalkeys3[i]});
            }
            
            //The options we are going to pass to the chart
            options = {
            };
            
            //Create the chart
           piechart3= new Chart(ctx).Doughnut(data, options);
            
            
            
	
	//alert(json);
	});
	//for(var k in finalresult){
	//keys.push(k);
//	values.push(finalresult[k]);
//	}

}


$(function() {
    $( "#thestartdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy'}).datepicker("setDate", "-10");
  });
  
$(function() {
    $( "#theenddatepicker" ).datepicker({ dateFormat: 'dd-mm-yy'}).datepicker("setDate", new Date());
  });

function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}



function shadeColor2(color, percent) {   
    var f=parseInt(color.slice(1),16),t=percent<0?0:255,p=percent<0?percent*-1:percent,R=f>>16,G=f>>8&0x00FF,B=f&0x0000FF;
    return "#"+(0x1000000+(Math.round((t-R)*p)+R)*0x10000+(Math.round((t-G)*p)+G)*0x100+(Math.round((t-B)*p)+B)).toString(16).slice(1);
}
	

</script>

<script>

var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var campaignid=$("#chartcampaignid").val();

var url="getIntervalMileReport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;
	//alert();
	//alert(url);
	$.getJSON(url,function(json){
	
	var keys = [];
     var values = [];


	 $.each(json, function(k,v) {
            keys.push(k);
            values.push(Math.round(v));
        });
        
        var lineChartData = {
		labels :keys,
		datasets : [
			
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data :  values
			}
		]

	}
            
		var ctx = document.getElementById("lineChart").getContext("2d");
		options = {
               pointDot : true,
               
               bezierCurve : false
            };
		
		linechart = new Chart(ctx).Line(lineChartData, options);
	
	
        
        
        
	});

//alert(startdatepicker);
	var url="getmilereport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;;
	//alert();
	$.getJSON(url,function(json){
//	alert();
	//var keys = [];
   // var values = [];
 //  var cities = Array()
   
//	var finalresult = {};
//    for(var i = 0;i<json.length;i++){
	//areacurrent = json[i][0];
//	cities.push(json[i][0]);
//	}
//	var cities  = JSON.parse(json);
var keys = [];
     var values = [];


	 $.each(json, function(k,v) {
            keys.push(k);
            values.push(Math.round(v));
        });
        
        var finalkeys = keys.slice(0, 10);
        var finalvalues = values.slice(0, 10);
        
         document.getElementById("citylist1").innerHTML+="<ul>";
        for(var i=0; i<finalkeys.length;i++){
        document.getElementById("citylist1").innerHTML+="<li>"+finalkeys[i]+": "+finalvalues[i]+"</li>";
        
        }
         document.getElementById("citylist1").innerHTML+="</ul>";
        
        
        var finalkeys2 = keys.slice(10, 30);
        var finalvalues2 = values.slice(10, 30);
          document.getElementById("citylist2").innerHTML+="<ul>";
        for(var i=0; i<finalkeys2.length;i++){
        document.getElementById("citylist2").innerHTML+="<li>"+finalkeys2[i]+": "+finalvalues2[i]+"</li>";
        
        }
         document.getElementById("citylist2").innerHTML+="</ul>";
        
        
        var finalkeys3 = keys.slice(30, 60);
        var finalvalues3 = values.slice(30, 60);
        
        document.getElementById("citylist3").innerHTML+="<ul>";
        for(var i=0; i<finalkeys3.length;i++){
        document.getElementById("citylist3").innerHTML+="<li>"+finalkeys3[i]+": "+finalvalues3[i]+"</li>";
        
        }
         document.getElementById("citylist3").innerHTML+="</ul>";
        
        var finalkeys4 = keys.slice(0, 15);
        var finalvalues4 = values.slice(0, 15);
        
        
    var barChartData = {
		labels :finalkeys4,
		datasets : [
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill: "rgba(151,187,205,0.75)",
				highlightStroke: "rgba(151,187,205,1)",
				data : finalvalues4
			}
		]

	}
            
		var ctx = document.getElementById("barChart").getContext("2d");
		options = {
                
                datasetStrokeWidth : 1,
                barValueSpacing:7
            };
		
		barchart = new Chart(ctx).Bar(barChartData, options);
		
		  var ctx = document.getElementById("pieChart").getContext("2d");
            var color;
         //   var shade = shadeColor2(color,0.2);
            //Create the data object to pass to the chart
            var data=[];
            for(var i = 0;i<finalkeys.length;i++){
            
             data.push({ value: finalvalues[i],
			        color:"rgba(151,187,205,1)",
			        highlight: "rgba(151,187,205,0.5)",
			        label: finalkeys[i]});
            }
            
            //The options we are going to pass to the chart
            options = {
            scaleShowLabels : true
            };
            
            //Create the chart
           piechart1 =  new Chart(ctx).Doughnut(data, options);
            
             var ctx = document.getElementById("pieChart2").getContext("2d");
            var color;
         //   var shade = shadeColor2(color,0.2);
            //Create the data object to pass to the chart
            var data=[];
            for(var i = 0;i<finalkeys2.length;i++){
            
             data.push({ value: finalvalues2[i],
			        color:"rgba(151,187,205,1)",
			        highlight: "rgba(151,187,205,0.5)",
			        label: finalkeys2[i]});
            }
            
            //The options we are going to pass to the chart
            options = {
            };
            
            //Create the chart
           piechart2 = new Chart(ctx).Doughnut(data, options);
            
            
            
             var ctx = document.getElementById("pieChart3").getContext("2d");
            var color;
         //   var shade = shadeColor2(color,0.2);
            //Create the data object to pass to the chart
            var data=[];
            for(var i = 0;i<finalkeys3.length;i++){
            
             data.push({ value: finalvalues3[i],
			        color:"rgba(151,187,205,1)",
			        highlight: "rgba(151,187,205,0.5)",
			        label: finalkeys3[i]});
            }
            
            //The options we are going to pass to the chart
            options = {
            };
            
            //Create the chart
           piechart3= new Chart(ctx).Doughnut(data, options);
            
            
            
	
	//alert(json);
	});
	//for(var k in finalresult){
	//keys.push(k);
//	values.push(finalresult[k]);
//	}

</script>
		


				
		
		<script>
            //Get the context of the canvas element we want to select
          var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	

	</script>



	<script>
	

//	for (var i = 0; i < json.features.length; i++) { 
	//var point =  new google.maps.LatLng(json.features[i].geometry.coordinates[1]
            //Get the context of the canvas element we want to select
         //  var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
// 
// 	var barChartData = {
// 		labels : ["January","February","March","April","May","June","July"],
// 		datasets : [
// 			
// 			{
// 				fillColor : "rgba(151,187,205,0.5)",
// 				strokeColor : "rgba(151,187,205,0.8)",
// 				highlightFill : "rgba(151,187,205,0.75)",
// 				highlightStroke : "rgba(151,187,205,1)",
// 				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
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

	</script>
	
	<script>
	//    var ctx = document.getElementById("pieChart").getContext("2d");
//             
//             //Create the data object to pass to the chart
//            var data = [
// 			   	 {
// 			        value: 300,
// 			        color:"#F7464A",
// 			        highlight: "#FF5A5E",
// 			        label: "Red"
// 			    },
// 			    {
// 			        value: 50,
// 			        color: "#46BFBD",
// 			        highlight: "#5AD3D1",
// 			        label: "Green"
// 			    },
// 			    {
// 			        value: 100,
// 			        color: "#FDB45C",
// 			        highlight: "#FFC870",
// 			        label: "Yellow"
// 			    }
// 				]
//             
//             //The options we are going to pass to the chart
//             options = {};
//             
//             //Create the chart
//             new Chart(ctx).Doughnut(data, options);
        </script>
