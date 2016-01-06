<?php
$campaignid=$_GET['campaignid'];
$deviceid=$_GET['deviceid'];
session_start();
$_SESSION['deviceid']=$_GET['deviceid'];
$_SESSION['campaign_id'] = $campaignid;

echo "<input type='hidden' id='chartcampaignid' value='$campaignid'></input>";



?>

<h4>
	<div class='row'>
		<div class="btn-group btn-group-justified">
		  <div class="btn-group">
			<button type="button" id='cimpressions_btn' class="btn btn-default" onclick='compareimpression()'><i class="fa fa-eye fa-lg"></i>Impressions</button>
		  </div>
		  <div class="btn-group">
			<button type="button" id='cmiles_btn' class="btn btn-default" onclick='comparemile()'><i class="fa fa-road fa-lg"></i>Miles</button>
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

<script>
var select = 1;
$(function() {
    $( "#thestartdatepicker" ).datepicker({ dateFormat: 'dd-mm-yy'}).datepicker("setDate", new Date(2014,9,1));
  });
  
$(function() {
    $( "#theenddatepicker" ).datepicker({ dateFormat: 'dd-mm-yy'}).datepicker("setDate", new Date(2014,9,31) );
  });
  

$(function() {

$("#data_area").load('compareimpression.php');
});

function compareimpression()
{
if(select != 1){
select = 1;
	$("#time_area").show();
   $("#cimpressions_btn").addClass('active');
   $("#cimpressions_btn").addClass('selected');
    $("#cmiles_btn").removeClass('active');
  $("#cmiles_btn").removeClass('selected');
  
$("#data_area").html("");
  $("#data_area").load('compareimpression.php');}
}

function comparemile()
{
if(select != 2){
select = 2;
	$("#time_area").show();
   $("#cmiles_btn").addClass('active');
   $("#cmiles_btn").addClass('selected');
    $("#cimpressions_btn").removeClass('active');
  $("#cimpressions_btn").removeClass('selected');
  
$("#data_area").html("");
  $("#data_area").load('comparemile.php');
  }
}


</script>
