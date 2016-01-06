<?php

$deviceid=$_GET['id'];
echo "<input type='hidden' id='chartsingledeviceid' value='$deviceid'></input>";
?>

	<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-line-chart fa-lg"></i>Miles</div>
  <div class="panel-body">
   <canvas id="slineChart" width="700" height="200"></canvas>
  </div>
</div>

	
	<div class="panel panel-default">
  		<div class="panel-heading"><i class="fa fa-bar-chart fa-lg"></i>Cities</div>
 			 <div class="panel-body">
			<canvas  id="sbarChart" width="700" height="300"></canvas>
			</div>
		</div>
		
		
		<div class="panel panel-default ">
 		 <div class="panel-heading"><i class="fa fa-pie-chart fa-lg"></i>Cities</div>
 			 <div class="panel-body">
 			 <div class='col-md-6'>
			<canvas id="spieChart" width="250" height="250"></canvas>
			</div>
			<div class="col-md-6">
				<div class='table_area'>
					<table class='table table-hover' id='citytable'>
						<tr class="info"><th>city</th><th>miles</th></tr>
						
						
					</table>
				</div>
				<div class="col-md-2 col-md-offset-5"><i class="fa fa-angle-double-down fa-lg"></i></div>
			</div>
		</div>
		</div>
		
		
	
		<!-- 
<div class='col-md-6'>
			<canvas id="pieChart" width="300" height="300"></canvas>
		</div>
 -->
		
	</div>
	
<!-- 
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
	 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
 -->




<script>



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


$(document).ready(function() {

var slinedone = false;
var sbardone = false;
var spiedone = false;
	

if(!slinedone){

var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var deviceid=$("#chartsingledeviceid").val();


var url="getIntervalSingleMileReport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&deviceid="+deviceid;
	
	$.getJSON(url,function(json){
	
	var keys = [];
     var values = [];


	 $.each(json, function(k,v) {
            keys.push(k);
            values.push(Math.round(v/1.60934));
        });
        
        
        var lineChartData = {
		labels :keys,
		datasets : [
			
			{
				fillColor : "#6199AE",
				strokeColor : "#004059",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data :  values
			}
		]

	}
            
		var ctx = document.getElementById("slineChart").getContext("2d");
		options = {
               pointDot : false,
               pointHitDetectionRadius : 2,
               scaleShowGridLines : false,
               bezierCurve : false
            };
		
		linechart = new Chart(ctx).Line(lineChartData, options);
	
	
        linedone = true;
        
        
	});
}

	

	
	$('#sbarChart').waypoint(function(direction) {
if(direction=="down" && !sbardone){
var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var deviceid=$("#chartsingledeviceid").val();
var barurl="getsinglemilereport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&deviceid="+deviceid;;


	$.getJSON(barurl,function(barjson){

var barkeys = [];
     var barvalues = [];


	 $.each(barjson, function(k,v) {
            barkeys.push(k);
            barvalues.push(Math.round(v/1.60934));
        });
        
        var barfinalkeys = barkeys.slice(0, 10);
        var barfinalvalues = barvalues.slice(0, 10);
        
        
        
        var barfinalkeys4 = barkeys.slice(0, 30);
        var barfinalvalues4 = barvalues.slice(0, 30);
        
        
    var barChartData = {
		labels :barfinalkeys4,
		datasets : [
			{
				fillColor : "#6199AE",
				strokeColor : "#004059",
				highlightFill: "rgba(151,187,205,0.75)",
				highlightStroke: "rgba(151,187,205,1)",
				data : barfinalvalues4
			}
		]

	}
            
		var ctx = document.getElementById("sbarChart").getContext("2d");
		options = {
                
                datasetStrokeWidth : 1,
               scaleShowGridLines : false,
                barValueSpacing:5
            };
		
		barchart = new Chart(ctx).Bar(barChartData, options);
		sbardone = true;
		});
		
}
}, { offset: "60%", context: '#dashborad' });		
		
		

	
	$('#pieChart').waypoint(function(direction) {
if(direction=="down" && !piedone){
var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var campaignid=$("#milescampaignid").val();
	var pieurl="getmilereport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;;


	$.getJSON(pieurl,function(piejson){
	
	var piekeys = [];
     var pievalues = [];


	 $.each(piejson, function(k,v) {
            piekeys.push(k);
            pievalues.push(Math.round(v/1.60934));
        });
        
        var piefinalkeys = piekeys.slice(0, 10);
        var piefinalvalues = pievalues.slice(0, 10);
        
        
        
        var piefinalkeys4 = piekeys.slice(0, 30);
        var piefinalvalues4 = pievalues.slice(0, 30);

		  var ctx = document.getElementById("pieChart").getContext("2d");
            var color;
         //   var shade = shadeColor2(color,0.2);
            //Create the data object to pass to the chart
            var data=[];
            for(var i = 0;i<piefinalkeys.length;i++){
            
             data.push({ value: piefinalvalues[i],
			        color:"#004059",
			        highlight: "#6199AE",
			        label: piefinalkeys[i]});
            }
            
            //The options we are going to pass to the chart
            options = {
            scaleShowLabels : true
            };
            
            //Create the chart
           piechart =  new Chart(ctx).Pie(data, options);
            
            var table = document.getElementById("citytable");
            for(var i=0;i<piekeys.length;i++){
    var row = table.insertRow(i+1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = piekeys[i];
    cell2.innerHTML = pievalues[i];
    }
         piedone = true;
	});
	}
}, { offset: "60%", context: '#dashborad' });		
		
	
	$('#pieChart2').waypoint(function(direction) {
if(direction=="down" && !pie2done){
var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var campaignid=$("#milescampaignid").val();


	var pie2url="getIntervalDriverMileReport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;;
	
	$.getJSON(pie2url,function(pie2json){
	var devices = [];
     var pie2values = [];

	 $.each(pie2json, function(k,v) {
            devices.push(k);
            pie2values.push(Math.round(v/1.60934));
        });
          var ctx = document.getElementById("pieChart2").getContext("2d");
            var color;
         //   var shade = shadeColor2(color,0.2);
            //Create the data object to pass to the chart
            var pie2data=[];
            for(var i = 0;i<devices.length;i++){
            
             pie2data.push({ value: pie2values[i],
			        color:"#004059",
			        highlight: "#6199AE",
			        label: devices[i]});
            }
            
            //The options we are going to pass to the chart
            options = {
            scaleShowLabels : true
            };
        
           piechart2 =  new Chart(ctx).Pie(pie2data, options);
            var table = document.getElementById("drivertable");
            for(var i=0;i<devices.length;i++){
    var row = table.insertRow(i+1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    cell1.innerHTML = devices[i];
    cell2.innerHTML = pie2values[i];
    }
    pie2done = true;
        });
        }
	}, { offset: "60%", context: '#dashborad' });
});


</script>
		

				
		
		<script>
            //Get the context of the canvas element we want to select
          var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	

	</script>
 


