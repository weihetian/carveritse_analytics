<?php

session_start();
$campaignid=$_SESSION['campaign_id'];
$campaignstart =$_SESSION['campaign_date'];
$_SESSION['deviceid']=$_GET['deviceid'];
echo "<input type='hidden' id='chartcampaignid' value='$campaignid'></input>";
echo "<input type='hidden' id='campaignstart' value='$campaignstart'></input>";

?>

	<h4>
	<div>
		<div class="btn-group btn-group-justified">
		<div class="btn-group">
			<button type="button" id='map_btn' class="btn btn-default active selected" onclick='profile()'><i class="fa fa-user fa-lg"></i>Profile</button>
		  </div>
		
		  <div class="btn-group">
			<button type="button" id='impressions_btn' class="btn btn-default" onclick='singleimpression()'><i class="fa fa-eye fa-lg"></i>Impressions</button>
		  </div>
		  <div class="btn-group">
			<button type="button" id='miles_btn' class="btn btn-default" onclick='singlemile()'><i class="fa fa-road fa-lg"></i>Miles</button>
		  </div>
		  
		  <div class="btn-group">
			<button type="button" id='path_btn' class="btn btn-default" onclick='singlepath()'><i class="fa fa-map-marker fa-lg"></i>Paths</button>
		  </div>
		  
		</div>
	</div>
	</h4>
	
</br>

<div id='time_area' class="well">
<h4>Time interval: <i class="fa fa-calendar"></i>

Start <input type="text" name="start" id="thestartdatepicker"></input> End <input type="text" name="start" id="theenddatepicker"></input> 
<button class='btn btn-sm btn-default' onclick="singlechangedate()">Submit</button>

</h4>
</div>


<div id='data_area'>
	
</div>
<script src="js/waypoints.js"></script>
<script>

$(document).ready(function() {
$("#time_area").hide();
$("#data_area").load('singleprofile.php');
});

 
var select = 1;
$(function() {	
	var cid = $('#campaignstart').val();
	var date = new Date(cid);
	var day = date.getDate()+1;
	  var month = date.getMonth();
	  var year = date.getFullYear();
		// var newDate = cid.toString('dd-MM-yy');
		// alert(day+"-"+month+"-"+year);
	    $( "#thestartdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy'}).datepicker("setDate", new Date(year,month,day));
	  });
  
$(function() {
    $( "#theenddatepicker" ).datepicker({ dateFormat: 'dd-mm-yy'}).datepicker("setDate",new Date() );
  });


// 
// $(document).ready(function() {
// //   $("#impresson_btn").addClass('active');
// //   $(this).removeClass('selected');
// });
// 
// var refreshIntervalId;
// 
function singlechangedate(){

$("#data_area").html("");
if(select == 2){
  $("#data_area").load('singleimpressionsummary.php');
  }else if(select == 3)
  {
  $("#data_area").load('singlemilessummary.php');
  }
}
// 
// $(document).ready(function() {
// $("#data_area").load('impressionsummary.php');
// });
// 
// 
//   
function singlepath()
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
  $("#data_area").load('singlepath.php');
}}

function singlemile(){
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
  $("#data_area").load('singlemilessummary.php');}
  }
//   
function profile(){
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
  $("#data_area").load('singleprofile.php');}
}

function singleimpression(){
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
  $("#data_area").load('singleimpressionsummary.php');
  }
}
</script>