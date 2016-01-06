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
   <canvas id="silineChart" width="700" height="200"></canvas>
   <br>
   <div id='label'>
   
   </div>
  </div>
</div>

<script>



var devicelist = [];
var valuelist = [];
var values = [];
var clinechart;
var lineChartData;
 var canvas = document.getElementById('silineChart');

 var width = $('.panel-body').width();
 var height = $('.panel-body').height();
            canvas.width = width;
            canvas.height = 250;

var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();
var deviceid;
//var deviceid=$("#milescampaigndeviceid").val();
devicelist.push($("#milescampaigndeviceid").val());



var ctx = document.getElementById("silineChart").getContext("2d");
		options = {
               pointDot : false,
               pointHitDetectionRadius : 2,
               scaleShowGridLines : false,
               bezierCurve : false
            };

deviceid = $("#milescampaigndeviceid").val();

var name = $("#drivername"+deviceid).val();





var url="getIntervalSingleImpressionReport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&deviceid="+deviceid;

	$.getJSON(url,function(json){
	
	var keys = [];
    // var values = [];
	
	var sum = 0;
	var num = 0;

	 $.each(json, function(k,v) {
            keys.push(k);
            values.push(Math.round(v));
            sum = sum + Math.round(v/1.60934);
            num++;
        });
        
      
        
        var color = 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256));
        var fill = color+',0.2)';
         var stroke = color+',0.7)';
         var full = color+',1)';
         
         var div = document.getElementById('label');
div.innerHTML = div.innerHTML + "<span class='label label-default' style='background-color:"+full+"'>"+name+"</span>   ";
//$("#label").html(name);

         
        lineChartData = {
		labels :keys,
		datasets : [
			
			{ 
            fillColor: fill,
            strokeColor: stroke,
            pointColor: full,
            pointStrokeColor: full,
            pointHighlightFill: full,
            pointHighlightStroke: full,
				data :  values
			}
		]

	}
	
	
            
		
		
		clinechart = new Chart(ctx).Line(lineChartData, options);
	
	
        
        
	});


function adddriver(id,cid)
{
clinechart.clear();
clinechart.destroy();

var name = $("#drivername"+id).val();

var url="getIntervalSingleImpressionReport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&deviceid="+id;

	$.getJSON(url,function(json){
	
	var keys = [];
    values = [];
	
	var sum = 0;
	var num = 0;

	 $.each(json, function(k,v) {
            keys.push(k);
            values.push(Math.round(v));
            sum = sum + Math.round(v/1.60934);
            num++;
        });
        
      
         var color = 'rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256));
        var fill = color+',0.2)';
         var stroke = color+',0.7)';
       var full = color+',1)';
       
                var div = document.getElementById('label');
div.innerHTML = div.innerHTML + "<span class='label label-default' style='background-color:"+full+"'>"+name+"</span>   ";

       
lineChartData.datasets.push({
            fillColor: fill,
            strokeColor: stroke,
            pointColor: full,
            pointStrokeColor: full,
            pointHighlightFill: full,
            pointHighlightStroke: full,
				data :  values
			});
		clinechart = new Chart(ctx).Line(lineChartData, options);
	
        
        
	});

}

</script>
