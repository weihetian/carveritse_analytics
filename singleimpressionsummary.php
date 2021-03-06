<?php
session_start();
$campaignid=$_SESSION['campaign_id'];
$deviceid=$_SESSION['deviceid'];
echo "<input type='hidden' id='milescampaignid' value='$campaignid'></input>
<input type='hidden' id='milescampaigndeviceid' value='$deviceid'></input>";
?>

	<div class="panel panel-default">
	
  <div class="panel-heading"><i class="fa fa-line-chart fa-lg"></i>
  
  impressions</div>
  <div class="panel-body">
  <h4><small>(Total:</small> <span class='totalimpression'>0</span><small>)</small></br><small>(Average:</small> <span class='averageimpression'>0</span><small> /day)</small>
  
  </h4>
   
   <canvas id="silineChart" width="700" height="200"></canvas>
  </div>
</div>

	
	<div class="panel panel-default">
  		<div class="panel-heading"><i class="fa fa-bar-chart fa-lg"></i>Cities</div>
 			 <div class="panel-body">
			<canvas  id="sibarChart" width="700" height="300"></canvas>
			</div>
		</div>
		
		
		<div class="panel panel-default ">
 		 <div class="panel-heading"><i class="fa fa-pie-chart fa-lg"></i>Cities</div>
 			 <div class="panel-body">
 			 <div class='col-md-6'>
			<canvas id="sipieChart" width="250" height="250"></canvas>
			</div>
			<div class="col-md-6">
				<div class='table_area panel panel-default'>
					<table class='table table-hover' id='citytable'>
						<tr class="info"><th>city</th><th>%</th><th>impressions</th></tr>
						
						
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
		
	
<!-- 
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
	 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
 -->





<script>



$(document).ready(function() {
 var canvas = document.getElementById('silineChart');
  var canvas1 = document.getElementById('sibarChart');
  var canvas2 = document.getElementById('sipieChart');
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
            
           
var silinedone = false;
var sibardone = false;
var sipiedone = false;
if(!silinedone){
var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var deviceid=$("#milescampaigndeviceid").val();


var url="getIntervalSingleImpressionReport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&deviceid="+deviceid;

	$.getJSON(url,function(json){
	
	var keys = [];
     var values = [];
	
	var sum = 0;
	var num = 0;

	 $.each(json, function(k,v) {
            keys.push(k);
            values.push(Math.round(v));
            sum = sum + Math.round(v/1.60934);
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
            
		var ctx = document.getElementById("silineChart").getContext("2d");
		options = {
               pointDot : false,
               pointHitDetectionRadius : 2,
               scaleShowGridLines : false,
               bezierCurve : false
            };
		
		slinechart = new Chart(ctx).Line(lineChartData, options);
	
	
        silinedone = true;
        
        
	});
}

	

	
	$('#sibarChart').waypoint(function(direction) {
if(direction=="down" && !sibardone){
var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var deviceid=$("#milescampaigndeviceid").val();

var barurl="getsingleimpressionreport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&deviceid="+deviceid;;


	$.getJSON(barurl,function(barjson){

var barkeys = [];
     var barvalues = [];


	 $.each(barjson, function(k,v) {
            barkeys.push(k);
            barvalues.push(Math.round(v));
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
            
		var ctx = document.getElementById("sibarChart").getContext("2d");
		options = {
                
                datasetStrokeWidth : 1,
               scaleShowGridLines : false,
                barValueSpacing:10
            };
		
		barchart = new Chart(ctx).Bar(barChartData, options);
		sibardone = true;
		});
		
}
}, { offset: "70%", context: '#dashborad' });		
// 		
// 		
// 
// 	
	$('#sipieChart').waypoint(function(direction) {
if(direction=="down" && !sipiedone){
var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var deviceid=$("#milescampaigndeviceid").val();
	var pieurl="getsingleimpressionreport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&deviceid="+deviceid;;


	$.getJSON(pieurl,function(piejson){
	
	var piekeys = [];
     var pievalues = [];
	var sum = 0;

	 $.each(piejson, function(k,v) {
            piekeys.push(k);
            pievalues.push(Math.round(v));
            sum = sum + v;
        });
        
        var piefinalkeys = piekeys.slice(0, 10);
        var piefinalvalues = pievalues.slice(0, 10);
        
          var othersum = 0;
        for(var k = 10; k<pievalues.length;k++){
        	othersum = othersum+pievalues[k];
        }
        
        
        var piefinalkeys4 = piekeys.slice(0, 30);
        var piefinalvalues4 = pievalues.slice(0, 30);

		  var ctx = document.getElementById("sipieChart").getContext("2d");
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
             data.push({ value: othersum,
			        color:"#6199AE",
			        highlight: "#004059",
			        label: "others"});
            
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
         sipiedone = true;
	});
	}
}, { offset: "70%", context: '#dashborad' });		
		
	
});


</script>
		


