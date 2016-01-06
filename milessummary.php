<?php
session_start();
$campaignid=$_SESSION['campaign_id'];
echo "<input type='hidden' id='milescampaignid' value='$campaignid'></input>";
?>

	<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-line-chart fa-lg"></i>Miles</div>
  <div class="panel-body">
   <h4><small>(Total:</small> <span class='totalmile'>0</span><small> miles)</small><br><small>(Average:</small> <span class='averagemile'>0</span><small> miles/day)</small></h4>
   <canvas id="lineChart" ></canvas>
  </div>
</div>

	
	<div class="panel panel-default">
  		<div class="panel-heading"><i class="fa fa-bar-chart fa-lg"></i>Cities</div>
 			 <div class="panel-body">
 			 
			<canvas  id="barChart" ></canvas>
			</div>
		</div>
		
	
		<div class="panel panel-default">
  		<div class="panel-heading"><i class="fa fa-bar-chart fa-lg"></i>Areas <div class='btn btn-default group_btn'>group</div></div>
 			 <div class="panel-body">
 			 <div style='width:100%;overflow:hidden;'>
				 <h4>Miles</h4>
				 <canvas  id="barChart2" style="float:left;" ></canvas>
 			 
				<canvas  id="pieChart3" style="float:left;" ></canvas>
			</div>
			<div style='width:100%;overflow:hidden;'>
				 <h4>Time Spent</h4>
				<canvas  id="barChart3" style="float:left;" ></canvas>
 			 
				<canvas  id="pieChart5" style="float:left;" ></canvas>
			</div>
			</div>
		</div>
		
		
		
		<div class="panel panel-default">
 		 <div class="panel-heading"><i class="fa fa-pie-chart fa-lg"></i>Time spent</div>
 			 <div class="panel-body">
 			 <div class='col-md-6'>
			<canvas id="pieChart4" width="250" height="250"></canvas>
			</div>
			<div class="col-md-6">
				<div class='table_area panel panel-default'>
					<table class='table table-hover' id='hourtable'>
						<tr class="info"><th>city</th><th>%</th><th>hours</th></tr>
						
						
					</table>
				</div>
				<div class="col-md-2 col-md-offset-5"><i class="fa fa-angle-double-down fa-lg"></i></div>
			</div>
		</div>
		</div>
		
		<div class="panel panel-default ">
 		 <div class="panel-heading"><i class="fa fa-pie-chart fa-lg"></i>Top 20 Cities</div>
 			 <div class="panel-body">
 			 <div class='col-md-6'>
			<canvas id="pieChart" width="250" height="250"></canvas>
			</div>
			<div class="col-md-6">
				<div class='table_area panel panel-default'>
					<table class='table table-hover' id='citytable'>
						<tr class="info"><th>city</th><th>%</th><th>miles</th></tr>
						
						
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
 			 	  <h4><small>(Total:</small> <span class='totalmiledriver'>0</span><small> miles)</small><br><small>(Average:</small> <span class='averagemiledriver'>0</span><small> miles/driver)</small></h4>
 
 			 	<canvas  id="pieChart2" width="250" height="250"></canvas>
 			 	</div>
 			 	<div class='col-md-6'>
 			 		<div class='table_area2 panel panel-default'>
					<table class='table table-hover' id='drivertable'>
						<tr class="info"><th>driver</th><th>%</th><th>miles</th></tr>
						
						
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
	
	
	
<div class='group_area_container container'>
	<div style='width:100%;height:20px;'><i onclick='closezip()' class="close fa fa-times"></i></div>
	<div class='col-md-6'>
	<div class="panel panel-default">
	 <div class="panel-heading">Areas</div>
		 <div class="panel-body area_body_container">
			 <div class='area_body_input'><input class='add_area_input'></input>  <span class='add_area_btn'>Add</span></div>
			 <div class='area_body'>
				 
			 </div>
	 </div>
</div>
</div>
	<div class='col-md-6'>
	<div class="panel panel-default">
	 <div class="panel-heading">Zipcodes</div>
		 <div class="panel-body zipcode_body">
	 </div>
</div>
</div>
<div class='btn btn-default' onclick='generate()'>Generate</div>
<div class='btn btn-default' onclick='save()'>Save</div>
</div>


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
var arealist=[];

var selectedziplist = [];

var areaindex = 1;

var single_area = function(color,name,id){
	this.color = color;
	this.name = name;
	this.id = id;
}

var single_zip = function(color,zip,miles,time,id,area){
	this.color = color;
	this.zip = zip;
	this.miles =miles;
	this.time=time;
	this.id = id;
	this.area = area;
}

$( ".group_btn" ).click(function() {
	
	$('.zipcode_body').html("");
	var startdatepicker = $("#thestartdatepicker").val();

	var enddatepicker = $("#theenddatepicker").val();

	var campaignid=$("#milescampaignid").val();
	
	var groupurl="load_areagroup.php?campaignid="+campaignid;
	
	$.getJSON(groupurl,function(resultjson){
		
		
		arealist = [];
		for(var a = 0;a<resultjson.areas.length;a++){
		
			console.log(resultjson);
			var area_name = resultjson.areas[a]['name'];
			
			var id =  resultjson.areas[a]['areaid'];
			var color = "black";
			
			var area = new single_area(color,area_name,id);
			areaindex=parseInt(id)+1;
			arealist.push(area);
			render_areas();
			
		}
		var barurl="getmilereport_area.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;
	
	
	
		$.getJSON(barurl,function(barjson){
		
		
		
		
			var index = 0;
			
			for(var i = 0; i<barjson.length;i++){
				var areaindex= -1;
		
				for(var a = 0;a<resultjson.zipcodes.length;a++){
					if(resultjson.zipcodes[a].zip == barjson[i].zip){
						
						areaindex=resultjson.zipcodes[a].areaid;
						//alert(areaindex);
						//ziplist.push(new single_zip("black",barjson[i].zip,barjson[i].mile,barjson[i].time,index,-1));
					}
		
				}
				ziplist.push(new single_zip("black",barjson[i].zip,barjson[i].mile,barjson[i].time,index,areaindex));
				//console.log("time is:"+barjson[i].time);
				index++;
			
			//	$('.zipcode_body').append(" "+barjson[i].zip+"<br>");
			}
		
			ziplist.sort(function(a, b) {
			    return a.zip - b.zip;
			});
		
			for(var i = 0; i<ziplist.length;i++){
				$('.zipcode_body').append("<div class='singlezip zip"+ziplist[i].id+"' onclick='select_zip(this,"+ziplist[i].id+")' style='color:"+ziplist[i].color+";'>"+ziplist[i].zip+"<div>");
			}
		
		})
		
	}
)
	
	
	
	$('.middle_layer').show();
	$('.group_area_container').show();
	render_areas();
});

$('.add_area_btn').click(function(){
	var area_name = $(".add_area_input").val();
	var color = "black";
	
	var area = new single_area(color,area_name,areaindex);
	areaindex++;
	arealist.push(area);
	$(".add_area_input").val("");
	render_areas();
})

function save(){
	
	
//	var a = $.JSON.encode(arealist);

var selected_zip = function(zip,area_id){
	this.zip = zip;
	this.area_id = area_id;
}

var selected_zip_list = [];

for(var i =0;i<ziplist.length;i++){
	if(ziplist[i].area != -1){
		selected_zip_list.push(new selected_zip(ziplist[i].zip,ziplist[i].area));
	}
}

var campaignid= $("#milescampaignid").val();
	$.ajax({
	   type: "POST",
	   data: {campaign_id:campaignid,area:JSON.stringify(arealist),zip:JSON.stringify(selected_zip_list)},
	   url: "save_groups.php",
	   success: function(msg){
		   alert("Saved");
	   }
	});
	
	
	
	for(var i=0;i<arealist.length;i++){
		
	}
}

function generate(){
	
	var barkeys = [];
	var barvalues = [];
	
	var timevalues = [];

	for(var i = 0;i<arealist.length;i++){
		barkeys.push(arealist[i].name);
		var num = 0;
		var timenum=0;
		for (var j = 0; j <ziplist.length;j++){
			if(ziplist[j].area == arealist[i].id){
				num+=ziplist[j].miles;
				timenum+=ziplist[j].time
				//	console.log(ziplist[j].time);
			}
		}
		barvalues.push(Math.round(num/1.60934));
		timevalues.push(Math.round(timenum));
	
	}
				


				    var barChartData = {
						labels :barkeys,
						datasets : [
							{
								fillColor : "#6199AE",
								strokeColor : "#004059",
								highlightFill: "rgba(151,187,205,0.75)",
								highlightStroke: "rgba(151,187,205,1)",
								data : barvalues
							}
						]

					}

						var ctx = document.getElementById("barChart2").getContext("2d");
						options = {

				                datasetStrokeWidth : 1,
				               scaleShowGridLines : false,
				                barValueSpacing:5
				            };

						var barchart = new Chart(ctx).Bar(barChartData, options);
						
						
						//time bar chart
					    var barChartData_time = {
							labels :barkeys,
							datasets : [
								{
									fillColor : "#6199AE",
									strokeColor : "#004059",
									highlightFill: "rgba(151,187,205,0.75)",
									highlightStroke: "rgba(151,187,205,1)",
									data : timevalues
								}
							]

						}
						
						var ctx_time = document.getElementById("barChart3").getContext("2d");

						options = {

				                datasetStrokeWidth : 1,
				               scaleShowGridLines : false,
				                barValueSpacing:5
				            };

						var barchart_time = new Chart(ctx_time).Bar(barChartData_time, options);
						
						
						

			  		  var ctx = document.getElementById("pieChart3").getContext("2d");
			              var color;
			           //   var shade = shadeColor2(color,0.2);
			              //Create the data object to pass to the chart
			              var data=[];
			              for(var i = 0;i<barkeys.length;i++){
            
			               data.push({ value: barvalues[i],
			  			        color:"#6199AE",
			  			        highlight: "#004059",
			  			        label: barkeys[i]});
			              }
            
			              // data.push({ value: othersum,
			    // 			        color:"#6199AE",
			    // 			        highlight: "#004059",
			    // 			        label: "others"});
            
			              //The options we are going to pass to the chart
			              options = {
			              scaleShowLabels : true
			              };
            
			              //Create the chart
			             var piechart =  new Chart(ctx).Pie(data, options);
						 
						 
   			  		  var ctx_time = document.getElementById("pieChart5").getContext("2d");
   			              var color;
   			           //   var shade = shadeColor2(color,0.2);
   			              //Create the data object to pass to the chart
   			              var data_time=[];
   			              for(var i = 0;i<barkeys.length;i++){
            
   			               data_time.push({ value: timevalues[i],
   			  			        color:"#6199AE",
   			  			        highlight: "#004059",
   			  			        label: barkeys[i]});
   			              }
            
   			              // data.push({ value: othersum,
   			    // 			        color:"#6199AE",
   			    // 			        highlight: "#004059",
   			    // 			        label: "others"});
            
   			              //The options we are going to pass to the chart
   			              options = {
   			              scaleShowLabels : true
   			              };
            
   			              //Create the chart
   			             var piechart_time =  new Chart(ctx_time).Pie(data_time, options);
						 
						 
						closezip();
}



var ziplist = [];



var current_area = -1;
var current_area_name;


function select_area(div,id){
	$('.area_div').css("background-color","white");
	$(div).css("background-color","#C1E0FF");
	
	$(".singlezip").css("background-color","white");
	for(var i=0;i<ziplist.length;i++){
		if(ziplist[i].area==id){
			$('.zip'+ziplist[i].id).css("background-color","#C1E0FF");
		}
	}
	
	current_area = id;
	
}

function delete_area(div,id){
//	$('.area_div').css("background-color","white");
//	$(div).css("background-color","#C1E0FF");
	
	//$(".singlezip").css("background-color","white");
	for(var i=0;i<ziplist.length;i++){
		if(ziplist[i].area==id){
			ziplist[i].area=-1;
			//$('.zip'+ziplist[i].id).css("background-color","#C1E0FF");
		}
	}
	
	for(var i=0;i<arealist.length;i++){
		if(arealist[i].id==id){
			
			arealist.splice(i,i+1);
			areaindex--;
		}
	}
	
	render_areas();
	
	current_area = -1;
	
}


function closezip(){
	$('.middle_layer').hide();
	$('.group_area_container').hide();
}

function select_zip(div,id){

	$(div).css("background-color","#C1E0FF");
	for(var i=0;i<ziplist.length;i++){
		if(ziplist[i].id==id){
			if(ziplist[i].area == current_area){
				ziplist[i].area=-1;
				$(div).css("background-color","white");
			}else{
			ziplist[i].area = current_area;
		}
		}
	}
}


function render_areas(){
	$('.area_body').html("");
	for(var i = 0; i<arealist.length;i++){
		$('.area_body').append("<div class='area_div' onclick='select_area(this,"+arealist[i].id+")' style='color:"+arealist[i].color+";'>"+arealist[i].name+"<a class='delete_area' onclick='delete_area(this,"+arealist[i].id+")' style='float:right;'>delete</a></div>");
	}
}


function custom_chart(){
	
}


$(document).ready(function() {
	
})

$(document).ready(function() {
	
	
	
 var canvas = document.getElementById('lineChart');
  var canvas1 = document.getElementById('barChart');
  

  
  var canvas2 = document.getElementById('pieChart');
  var canvas3 = document.getElementById('pieChart2');
  
  

  var canvas4 = document.getElementById('barChart2');

  var canvas5 = document.getElementById('pieChart3');
  

  var canvas7 = document.getElementById('pieChart4');
  
   var canvas8 = document.getElementById('barChart3');
   var canvas9 = document.getElementById('pieChart5');
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
			
           canvas4.width = width/2;
           canvas4.height = 400;
		   
		   canvas5.width = width/2-50;
           canvas5.height = width/2-50;
		   
           canvas8.width = width/2;
           canvas8.height = 400;
		   
		   canvas9.width = width/2-50;
           canvas9.height = width/2-50;
		   
		   
		   canvas7.width = width/3;
           canvas7.height = width/3;
            
           // $('.table_area').height = width/3;
        //    $('.table_area2').height = width/3;
            /**
             * Your drawings need to be inside this function otherwise they will be reset when 
             * you resize the browser window and the canvas goes will be cleared.
             */
   //         drawStuff(); 
   // }
  //  resizeCanvas();


var linedone = false;
var bardone = false;
var piedone = false;
var pie2done = false;

var pie4done = false;

var bardone2 = false;

if(!linedone){

var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var campaignid=$("#milescampaignid").val();


var url="getIntervalMileReport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;
	
	$.getJSON(url,function(json){
	
	var keys = [];
     var values = [];
	var sum = 0;
	var num = 0;
	 $.each(json, function(k,v) {
            keys.push(k);
            values.push(Math.round(v/1.60934));
            sum = sum + Math.round(v/1.60934);
            num++;
        });
        
        jQuery({someValue: 0}).animate({someValue: sum}, {
	duration: 1500,
	easing:'swing', // can be anything
	step: function() { // called on every step
		// Update the element's text with rounded-up value:
		$('.totalmile').text(Math.ceil(this.someValue));
	}
});  

 jQuery({someValue: 0}).animate({someValue: sum/num}, {
	duration: 1500,
	easing:'swing', // can be anything
	step: function() { // called on every step
		// Update the element's text with rounded-up value:
		$('.averagemile').text(Math.ceil(this.someValue));
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
            
		var ctx = document.getElementById("lineChart").getContext("2d");
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


// $("#barChart2").waypoint(function(direction) {
//
//
// 	if(direction=="down" && !bardone2){
// 		var startdatepicker = $("#thestartdatepicker").val();
//
// 		var enddatepicker = $("#theenddatepicker").val();
//
// 		var campaignid=$("#milescampaignid").val();
// 		var barurl="getmilereport_area.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;
//
// 		$.getJSON(barurl,function(barjson){
//
//
// 			var index = 0;
//
// 			for(var i = 0; i<barjson.length;i++){
// 				ziplist.push(new single_zip("black",barjson[i].zip,index,-1));
// 				index++;
//
// 			//	$('.zipcode_body').append(" "+barjson[i].zip+"<br>");
// 			}
//
// 			ziplist.sort(function(a, b) {
// 			    return a.zip - b.zip;
// 			});
//
// 			for(var i = 0; i<ziplist.length;i++){
// 				$('.zipcode_body').append("<div class='singlezip zip"+ziplist[i].id+"' onclick='select_zip(this,"+ziplist[i].id+")' style='color:"+ziplist[i].color+";'>"+ziplist[i].zip+"<div>");
// 			}
//
// 			var barkeys = [];
// 			var barvalues = [];
//
//
// 				 $.each(barjson, function(k,v) {
// 			            barkeys.push(k);
// 			            barvalues.push(Math.round(v/1.60934));
// 			        });
//
//
// 			    var barChartData = {
// 					labels :barkeys,
// 					datasets : [
// 						{
// 							fillColor : "#6199AE",
// 							strokeColor : "#004059",
// 							highlightFill: "rgba(151,187,205,0.75)",
// 							highlightStroke: "rgba(151,187,205,1)",
// 							data : barvalues
// 						}
// 					]
//
// 				}
//
// 					var ctx = document.getElementById("barChart2").getContext("2d");
// 					options = {
//
// 			                datasetStrokeWidth : 1,
// 			               scaleShowGridLines : false,
// 			                barValueSpacing:5
// 			            };
//
// 					barchart = new Chart(ctx).Bar(barChartData, options);
// 					bardone = true;
//
//
//
// 		}
// 	)
//
//
// 	}
//
// }, { offset: "70%", context: '#dashborad' });
	
	

	
	$('#barChart').waypoint(function(direction) {
if(direction=="down" && !bardone){

var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var campaignid=$("#milescampaignid").val();
var barurl="getmilereport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;;


	$.getJSON(barurl,function(barjson){

var barkeys = [];
     var barvalues = [];


	 $.each(barjson, function(k,v) {
            barkeys.push(k);
            barvalues.push(Math.round(v/1.60934));
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
            
		var ctx = document.getElementById("barChart").getContext("2d");
		options = {
                
                datasetStrokeWidth : 1,
               scaleShowGridLines : false,
                barValueSpacing:5
            };
		
		barchart = new Chart(ctx).Bar(barChartData, options);
		bardone = true;
		});
		
}
}, { offset: "70%", context: '#dashborad' });		
		
		

	
	$('#pieChart').waypoint(function(direction) {
if(direction=="down" && !piedone){
var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var campaignid=$("#milescampaignid").val();
	var pieurl="getmilereport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;;


	$.getJSON(pieurl,function(piejson){
	
	var piekeys = [];
     var pievalues = [];

	var sum = 0;
	
	 $.each(piejson, function(k,v) {
            piekeys.push(k);
            pievalues.push(Math.round(v/1.60934));
            sum = sum+Math.round(v/1.60934);
        });
        
        
        
        var piefinalkeys = piekeys.slice(0, 20);
        var piefinalvalues = pievalues.slice(0, 20);
        
        var othersum = 0;
        for(var k = 20; k<pievalues.length;k++){
        	othersum = othersum+pievalues[k];
        }
        
        var piefinalkeys4 = piekeys.slice(0, 30);
        var piefinalvalues4 = pievalues.slice(0, 30);

		  var ctx = document.getElementById("pieChart").getContext("2d");
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
  // 			        color:"#6199AE",
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
         piedone = true;
	});
	}
}, { offset: "70%", context: '#dashborad' });		
		
	
	$('#pieChart2').waypoint(function(direction) {
if(direction=="down" && !pie2done){
var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var campaignid=$("#milescampaignid").val();


	var pie2url="getIntervalDriverMileReport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;
	
	$.getJSON(pie2url,function(pie2json){
	var devices = [];
     var pie2values = [];
	var sum2 = 0 ;
	var num2=0;
	 $.each(pie2json, function(k,v) {
            devices.push(k);
            pie2values.push(Math.round(v/1.60934));
            sum2 = sum2 + Math.round(v/1.60934);
            num2++;
        });
        
        
               jQuery({someValue: 0}).animate({someValue: sum2}, {
	duration: 1500,
	easing:'swing', // can be anything
	step: function() { // called on every step
		// Update the element's text with rounded-up value:
		$('.totalmiledriver').text(Math.ceil(this.someValue));
	}
});  

 jQuery({someValue: 0}).animate({someValue: sum2/num2}, {
	duration: 1500,
	easing:'swing', // can be anything
	step: function() { // called on every step
		// Update the element's text with rounded-up value:
		$('.averagemiledriver').text(Math.ceil(this.someValue));
	}
});  
        
          var ctx = document.getElementById("pieChart2").getContext("2d");
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
    pie2done = true;
        });
        }
	}, { offset: "70%", context: '#dashborad' });
	
	
	
	
	$('#pieChart4').waypoint(function(direction) {
if(direction=="down" && !pie4done){
var startdatepicker = $("#thestartdatepicker").val();

var enddatepicker = $("#theenddatepicker").val();

var campaignid=$("#milescampaignid").val();


var pieurl="getIntervalTimeReport.php?startdate="+startdatepicker+"&enddate="+enddatepicker+"&campaignid="+campaignid;;


	$.getJSON(pieurl,function(piejson){
	
	var piekeys = [];
     var pievalues = [];

	var sum = 0;
	
	 $.each(piejson, function(k,v) {
            piekeys.push(k);
            pievalues.push(v);
		//	console.log(v);
            sum = sum+v;
        });
        
        
        
        var piefinalkeys = piekeys.slice(0, 20);
        var piefinalvalues = pievalues.slice(0, 20);
        
        var othersum = 0;
        for(var k = 20; k<pievalues.length;k++){
        	othersum = othersum+pievalues[k];
        }
        
        var piefinalkeys4 = piekeys.slice(0, 30);
        var piefinalvalues4 = pievalues.slice(0, 30);

		  var ctx = document.getElementById("pieChart4").getContext("2d");
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
          
            options = {
            scaleShowLabels : true
            };
            
           piechart =  new Chart(ctx).Pie(data, options);
            
            var table = document.getElementById("hourtable");
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
         pie4done = true;
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


