<?php
session_start();
$campaignid=$_SESSION['campaign_id'];
echo "<input type='hidden' id='milescampaignid' value='$campaignid'></input>";
?>

	<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-line-chart fa-lg"></i>impressions</div>
  <div class="panel-body">
  <h4><small>(Total:</small> <span class='totalimpression'>0</span><small>)</small><br><small>(Average:</small> <span class='averageimpression'>0</span><small> /day)</small></h4>
   <canvas id="ilineChart" width="700" height="200"></canvas>
  </div>
</div>

	
	<div class="panel panel-default">
  		<div class="panel-heading"><i class="fa fa-bar-chart fa-lg"></i>Cities</div>
 			 <div class="panel-body">
			<canvas  id="ibarChart" width="700" height="300"></canvas>
			</div>
		</div>
		
		
		<div class="panel panel-default ">
 		 <div class="panel-heading"><i class="fa fa-pie-chart fa-lg"></i>Top Cities</div>
 			 <div class="panel-body">
 			 <div class='col-md-6'>
			<canvas id="ipieChart" width="250" height="250"></canvas>
			</div>
			<div class="col-md-6">
				<div class='table_area panel panel-default'>
					<table class='table table-hover' id='citytable'>
						<tr class="info"><th>County</th><th>%</th><th>impressions</th></tr>
						
						
					</table>
				</div>
				<div class="col-md-2 col-md-offset-5"><i class="fa fa-angle-double-down fa-lg"></i></div>
			</div>
		</div>
		</div>
		
		<div class="panel panel-default">
  			<div class="panel-heading"><i class="fa fa-users fa-lg"></i>Drivers</div>
 			 <div class="panel-body">
 			 	<div class='col-md-6'>
 			 	  <h4><small>(Total:</small> <span class='totalimpressiondriver'>0</span><small>)</small><br><small>(Average:</small> <span class='averageimpressiondriver'>0</span><small> /driver)</small></h4>
 
 			 	<canvas  id="ipieChart2" width="250" height="250"></canvas>
 			 	</div>
 			 	<div class='col-md-6'>
 			 		<div class='table_area2 panel panel-default'>
					<table class='table table-hover' id='drivertable'>
						<tr class="info"><th>driver</th><th>%</th><th>impressions</th></tr>
						
						
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

 var canvas = document.getElementById('ilineChart');
  var canvas1 = document.getElementById('ibarChart');
  var canvas2 = document.getElementById('ipieChart');
  var canvas3 = document.getElementById('ipieChart2');
   //var table = document.getElementById('table_area');
  // var table2 = document.getElementById('table_area2');
 
 var width = $('.panel-body').width();
 var height = $('.panel-body').height();
          //  context = canvas.getContext('2d');

    // resize the canvas to fill browser window dynamically
   // window.addEventListener('resize', resizeCanvas, false);

  //  function resizeCanvas() {
            canvas.width = width;
            canvas.height = 250;
			 canvas1.width = width;
            canvas1.height = 400;
             canvas2.width = width/3;
            canvas2.height = width/3;
            
             canvas3.width = width/3;
            canvas3.height = width/3;

var ilinedone = false;
var ibardone = false;
var ipiedone = false;
var ipie2done = false;
	

if(!ilinedone){

var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var campaignid=$("#milescampaignid").val();


var url="getIntervalImpressionReport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;
	
	$.getJSON(url,function(json){
	
	var keys = [];
     var values = [];
	
	var sum = 0;
	var num = 0;

	 $.each(json, function(k,v) {
            keys.push(k);
            values.push(Math.round(v));
            sum = sum + Math.round(v);
            num++;
        });
        
                jQuery({someValue: 0}).animate({someValue: sum}, {
	duration: 1500,
	easing:'swing', // can be anything
	step: function() { // called on every step
		// Update the element's text with rounded-up value:
		$('.totalimpression').text(Math.ceil(this.someValue));
	}
});  

 jQuery({someValue: 0}).animate({someValue: sum/num}, {
	duration: 1500,
	easing:'swing', // can be anything
	step: function() { // called on every step
		// Update the element's text with rounded-up value:
		$('.averageimpression').text(Math.ceil(this.someValue));
	}
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
            
		var ctx = document.getElementById("ilineChart").getContext("2d");
		options = {
               pointDot : false,
               pointHitDetectionRadius : 2,
               scaleShowGridLines : false,
               bezierCurve : false
            };
		
		linechart = new Chart(ctx).Line(lineChartData, options);
	
	
        ilinedone = true;
        
        
	});
}

	

	
	$('#ibarChart').waypoint(function(direction) {
if(direction=="down" && !ibardone){
var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var campaignid=$("#milescampaignid").val();
var barurl="getimpressionreport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;;


	$.getJSON(barurl,function(barjson){

var barkeys = [];
     var barvalues = [];


	 $.each(barjson, function(k,v) {
            barkeys.push(k);
            barvalues.push(Math.round(v));
        });
        
        var barfinalkeys = barkeys.slice(0, 10);
        var barfinalvalues = barvalues.slice(0, 10);
        
        
        
        var barfinalkeys4 = barkeys.slice(0, 25);
        var barfinalvalues4 = barvalues.slice(0, 25);
        
        
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
            
		var ctx = document.getElementById("ibarChart").getContext("2d");
		options = {
                
                datasetStrokeWidth : 1,
               scaleShowGridLines : false,
                barValueSpacing:5
            };
		
		barchart = new Chart(ctx).Bar(barChartData, options);
		ibardone = true;
		});
		
}
}, { offset: "70%", context: '#dashborad' });		
		
		

	
	$('#ipieChart').waypoint(function(direction) {
if(direction=="down" && !ipiedone){
var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var campaignid=$("#milescampaignid").val();
	var pieurl="getimpressionreport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;;


	$.getJSON(pieurl,function(piejson){
	
	var piekeys = [];
     var pievalues = [];
	var sum = 0;

	 $.each(piejson, function(k,v) {
            piekeys.push(k);
            pievalues.push(Math.round(v));
            sum = sum + v;
        });
        
        var piefinalkeys = piekeys.slice(0, 20);
        var piefinalvalues = pievalues.slice(0, 20);
        
          var othersum = 0;
        for(var k = 20; k<pievalues.length;k++){
        	othersum = othersum+pievalues[k];
        }
        
        
        var piefinalkeys4 = piekeys.slice(0, 30);
        var piefinalvalues4 = pievalues.slice(0, 30);

		  var ctx = document.getElementById("ipieChart").getContext("2d");
            var color;
         //   var shade = shadeColor2(color,0.2);
            //Create the data object to pass to the chart
            var data=[];
            for(var i = 0;i<piefinalkeys.length;i++){
            
             data.push({ value: piefinalvalues[i],
			        color:"#6199AE",
			        highlight: "#004059",
			        label: piefinalkeys[i]});
            }
             // data.push({ value: othersum,
         // 			       color:"#6199AE",
         // 			        highlight: "#004059",
         // 			        label: "others"});
            
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
    var cell3 = row.insertCell(1);
    var cell2 = row.insertCell(2);
    cell1.innerHTML = piekeys[i];
    cell2.innerHTML = pievalues[i];
      var per = Math.round(pievalues[i]/sum*100);
     if(per<1){
   cell3.innerHTML = "<1%";
    }else
    {
     cell3.innerHTML = per + "%";
    }
    
    }
         ipiedone = true;
	});
	}
}, { offset: "70%", context: '#dashborad' });		
		
	
	$('#ipieChart2').waypoint(function(direction) {
if(direction=="down" && !ipie2done){
var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var campaignid=$("#milescampaignid").val();


	var pie2url="getIntervalDriverImpressionReport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;;
	
	$.getJSON(pie2url,function(pie2json){
	var devices = [];
     var pie2values = [];

var sum2 = 0;
var num2 = 0;
	 $.each(pie2json, function(k,v) {
            devices.push(k);
            pie2values.push(Math.round(v));
            sum2 = sum2 + Math.round(v);
            num2++;
        });
        
         
               jQuery({someValue: 0}).animate({someValue: sum2}, {
	duration: 1500,
	easing:'swing', // can be anything
	step: function() { // called on every step
		// Update the element's text with rounded-up value:
		$('.totalimpressiondriver').text(Math.ceil(this.someValue));
	}
});  

 jQuery({someValue: 0}).animate({someValue: sum2/num2}, {
	duration: 1500,
	easing:'swing', // can be anything
	step: function() { // called on every step
		// Update the element's text with rounded-up value:
		$('.averageimpressiondriver').text(Math.ceil(this.someValue));
	}
}); 
        
          var ctx = document.getElementById("ipieChart2").getContext("2d");
            var color;
         //   var shade = shadeColor2(color,0.2);
            //Create the data object to pass to the chart
            var pie2data=[];
            for(var i = 0;i<devices.length;i++){
            
             pie2data.push({ value: pie2values[i],
			        color:"#6199AE",
			        highlight: "#004059",
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
      var cell3 = row.insertCell(1);
    var cell2 = row.insertCell(2);
    cell1.innerHTML = devices[i];
    cell2.innerHTML = pie2values[i];
    
      var per = Math.round(pie2values[i]/sum2*100);
        if(per<1){
   cell3.innerHTML = "<1%";
    }else
    {
     cell3.innerHTML = per + "%";
    }
    }
    ipie2done = true;
        });
        }
	}, { offset: "70%", context: '#dashborad' });
});


$(document).ready(function() {

});
</script>
		

				
		
		<script>
            //Get the context of the canvas element we want to select
          var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	

	</script>


