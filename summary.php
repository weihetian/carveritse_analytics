<?php

session_start();
$campaignid=$_SESSION['campaign_id'];
$campaignstart =$_SESSION['campaign_date'];
echo "<input type='hidden' id='chartcampaignid' value='$campaignid'></input>";
echo "<input type='hidden' id='campaignstart' value='$campaignstart'></input>";
?>

	<h4>
	<div >
		<div class="btn-group btn-group-justified">
		<div class="btn-group">
			<button type="button" id='map_btn' class="btn btn-default" onclick='livemap()'><i class="fa fa-map-marker fa-lg"></i>Map</button>
		  </div>
		
		  <div class="btn-group">
			<button type="button" id='impressions_btn' class="btn btn-default" onclick='impression()'><i class="fa fa-eye fa-lg"></i>Impressions</button>
		  </div>
		  <div class="btn-group">
			<button type="button" id='miles_btn' class="btn btn-default  active selected" onclick='mile()'><i class="fa fa-road fa-lg"></i>Miles</button>
		  </div>
		  
		  <div class="btn-group">
			<button type="button" id='path_btn' class="btn btn-default" onclick='path()'><i class="fa fa-map-marker fa-lg"></i>Paths</button>
		  </div>
		  
		</div>
	</div>
	</h4>
	
</br>
<div id='time_area' class="well">
<h4>Time interval: <i class="fa fa-calendar"></i>

Start <input type="text" name="start" id="thestartdatepicker"></input> End <input type="text" name="start" id="theenddatepicker"></input> 
<button class='btn btn-sm btn-default' onclick="changedate()">Submit</button>

</h4>
</div>

<!-- 
<div  class="well">
<h4>Time interval: <i class="fa fa-calendar"></i>
<small>
Start <input type="text" name="start" id="thestartdatepicker"></input> End <input type="text" name="start" id="theenddatepicker"></input> 
<button class='btn btn-sm btn-default' onclick="changedate()">Submit</button>
</small>
</h4>
	
	
	<div class='row'>
		<div class="btn-group btn-group-justified">
		  <div class="btn-group">
			<button type="button" class="btn btn-default" onclick='impression()'><i class="fa fa-eye fa-lg"></i>Impressions</button>
		  </div>
		  <div class="btn-group">
			<button type="button" class="btn btn-default" onclick='mile()'><i class="fa fa-road fa-lg"></i>Miles</button>
		  </div>
		  <div class="btn-group">
			<button type="button" class="btn btn-default" onclick='map()'><i class="fa fa-map-marker fa-lg"></i>Map</button>
		  </div>
		</div>
	</div>


</div>
 -->

<div id='data_area'>
	
</div>
<script src="js/waypoints.js"></script>
<script>
var linechart;
var piechart;
var piechart2;

var select = 3;


$(function() {

	var cid = $('#campaignstart').val();
//	var d = $.datepicker.parseDate("YY-MM-DD",  cid);
	//var datestrInNewFormat = $.datepicker.formatDate( "mm/dd/yy", d);
	//alert(d);
var date = new Date(cid);
var day = date.getDate()+1;
  var month = date.getMonth();
  var year = date.getFullYear();
	// var newDate = cid.toString('dd-MM-yy');
	// alert(day+"-"+month+"-"+year);
    $( "#thestartdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy'}).datepicker("setDate", new Date(year,month,day));
  });
  
$(function() {
    $( "#theenddatepicker" ).datepicker({ dateFormat: 'dd-mm-yy'}).datepicker("setDate", new Date() );
  });

$(document).ready(function() {
//   $("#impresson_btn").addClass('active');
//   $(this).removeClass('selected');
});

var refreshIntervalId;

function changedate(){

$("#data_area").html("");
if(select == 2){
  $("#data_area").load('impressionsummary.php');
  }else if(select == 3)
  {
  $("#data_area").load('milessummary.php');
  }
}

$(document).ready(function() {
$("#data_area").load('milessummary.php');
});


  
function path()
{
if(select !=4){
select = 4;
	$("#time_area").hide();
$("#path_btn").addClass('active');
   $("#path_btn").addClass('selected');
    $("#miles_btn").removeClass('active');
  $("#miles_btn").removeClass('selected');
  
    $("#map_btn").removeClass('active');
  $("#map_btn").removeClass('selected');
  
    $("#impressions_btn").removeClass('active');
  $("#impressions_btn").removeClass('selected');
  $("#data_area").html("");
  $("#data_area").load('path.php');
}}

function mile(){
if(select != 3){
select = 3;
	$("#time_area").show();
   $("#miles_btn").addClass('active');
   $("#miles_btn").addClass('selected');
    $("#impressions_btn").removeClass('active');
  $("#impressions_btn").removeClass('selected');
  
    $("#map_btn").removeClass('active');
  $("#map_btn").removeClass('selected');
  
    $("#path_btn").removeClass('active');
  $("#path_btn").removeClass('selected');
$("#data_area").html("");
  $("#data_area").load('milessummary.php');}
  }
  
function livemap(){
if(select !=1){
select = 1;
	$("#time_area").hide();
   $("#map_btn").addClass('active');
   $("#map_btn").addClass('selected');
    $("#impressions_btn").removeClass('active');
  $("#impressions_btn").removeClass('selected');
  
    $("#miles_btn").removeClass('active');
  $("#miles_btn").removeClass('selected');
  
    $("#path_btn").removeClass('active');
  $("#path_btn").removeClass('selected');
$("#data_area").html("");
  $("#data_area").load('mapsummary.php');}
}

function impression(){
if(select !=2){
	select = 2;
	$("#time_area").show();
   $("#impressions_btn").addClass('active');
   $("#impressions_btn").addClass('selected');
    $("#miles_btn").removeClass('active');
  $("#miles_btn").removeClass('selected');
  
    $("#map_btn").removeClass('active');
  $("#map_btn").removeClass('selected');
  
    $("#path_btn").removeClass('active');
  $("#path_btn").removeClass('selected');
$("#data_area").html("");
  $("#data_area").load('impressionsummary.php');}
}
</script>