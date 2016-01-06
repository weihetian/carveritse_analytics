<?php

$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$id=$_GET['id'];

$result = mysqli_query($con,"SELECT * FROM device WHERE id = '$id'")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result)) {
		 $id= $row['id'];
		$deviceid = $row['deviceid'];
		$carid = $row['carid'];
		$driver = $row['drivername'];
		$rawinfo = $row['info'];
		
		$dinfo = str_replace(array("'"), " ", $rawinfo); 
		$dinfo = str_replace(array('\r\n', '\r', '\n'), "\n", $dinfo);
		
		$info = str_replace(array('\r\n', '\r', '\n'), "<br />", $rawinfo); 
		$info = str_replace(array("'"), " ", $info); 
		$driverpic=$row['driverpic'];
		$front = $row['front'];	
		$back = $row['back'];	
		$left = $row['leftpic'];	
		$right = $row['rightpic'];	
		
		}

echo "
<ul class='list-group'>
  <li class='list-group-item'>id: $id</li>
  <li class='list-group-item' >deviceid: <span id='deviceid_area'>$deviceid</span>
  	<div class='pull-right'><i class='fa fa-pencil-square-o icon_button' onclick='editdeviceid($id)' ></i></div>
  		
  		<div class='well well-sm' id='deviceid_area_edit' style='display: none'>
  			<form id='edit_deviceid_form' role='form' enctype='multipart/form-data'>
  				<input type='hidden' name='id' value='$id'></input>
  				<input  type='text' name='deviceid' class='form-control' placeholder='New deviceid'></input>
  			</form>
  	
		<i class='fa fa-check icon_button' onclick='editdeviceid_edit()'></i>
		
		<i class='fa fa-times icon_button' onclick='editdeviceid_cancel()'></i>
		
		</div>
  </li>
  <li class='list-group-item'>carid: <span id='carid_area'>$carid</span>
  		<div class='pull-right'><i class='fa fa-pencil-square-o icon_button' onclick='editcarid($id)' ></i></div>
  		<div class='well well-sm' id='carid_area_edit' style='display: none'>
  			<form id='edit_carid_form' role='form' enctype='multipart/form-data'>
  				<input type='hidden' name='id' value='$id'></input>
  				<input  type='text' name='carid' class='form-control' placeholder='New carid'></input>
  			</form>
		<i class='fa fa-check icon_button' onclick='editcarid_edit()'></i>
		
		<i class='fa fa-times icon_button' onclick='editcarid_cancel()'></i>
		
  	</div>
  </li>
  <li class='list-group-item'>driver: $driver</li>
  <li class='list-group-item'>info: <div class='pull-right'><i class='fa fa-pencil-square-o icon_button' onclick='editinfo($id)' ></i></div>
   <span id='info_area'>$info</span>
  			
  		<div class='well well-sm' id='info_area_edit' style='display: none'>
  			<input type='text' id='pull_car_id' class='form-control' placeholder='carid' style='width:20%;'></input>

  			<button type='button' id='pull_car' class='btn btn-primary btn-xs' >Pull Data</button>
  			<br>
  			<br>
  			<div id='pull_data_area'>
  			
  			</div>
  			<form id='edit_info_form' role='form' enctype='multipart/form-data'>
  				<input type='hidden' name='id' value='$id'></input>
  				<textarea  id='info_text_area' type='text' name='info' class='form-control' rows='10' placeholder='New info'></textarea>
  			</form>
  		
		<i class='fa fa-check icon_button' onclick='editinfo_edit()'></i>
		
		<i class='fa fa-times icon_button' onclick='editinfo_cancel()'></i>
		
  	</div>
  </li>
  
   <li class='list-group-item'>driverpic:
  <div class='pull-right'><i class='fa fa-pencil-square-o icon_button' onclick='editdriverpic($id)' ></i></div>
  <br> <span id='driverpic_area'>
  <img src='$driverpic' style='width:50%;'>
  </span>
  
  	
  		<div class='well well-sm' id='driverpic_area_edit' style='display: none'>
  			<form id='edit_driverpic_form' role='form' enctype='multipart/form-data'>
  				<input type='hidden' name='id' value='$id'></input>
  				 <input type='file' name='driverpic'>
  				
  			</form>
  	
		<i class='fa fa-check icon_button' onclick='editdriverpic_edit()'></i>

		<i class='fa fa-times icon_button' onclick='editdriverpic_cancel()'></i>
	
  	</div>
  </li>
  
  <li class='list-group-item'>frontpic:
  <div class='pull-right'><i class='fa fa-pencil-square-o icon_button' onclick='editfrontpic($id)' ></i></div>
  <br> <span id='frontpic_area'>
  <img src='$front' style='width:50%;'>
  </span>
  
  	
  		<div class='well well-sm' id='frontpic_area_edit' style='display: none'>
  			<form id='edit_frontpic_form' role='form' enctype='multipart/form-data'>
  				<input type='hidden' name='id' value='$id'></input>
  				 <input type='file' name='front'>
  				
  			</form>
  	
		<i class='fa fa-check icon_button' onclick='editfrontpic_edit()'></i>

		<i class='fa fa-times icon_button' onclick='editfrontpic_cancel()'></i>
	
  	</div>
  </li>
  <li class='list-group-item'>backpic:
  <div class='pull-right'><i class='fa fa-pencil-square-o icon_button' onclick='editbackpic($id)' ></i></div>
  <br>
  <span id='backpic_area'>
  <img src='$back' style='width:50%;'>
  </span>
  
  	<div class='well well-sm' id='backpic_area_edit' style='display: none'>
  			<form id='edit_backpic_form' role='form' enctype='multipart/form-data'>
  				<input type='hidden' name='id' value='$id'></input>
  				 <input type='file' name='back'>
  				
  			</form>
  		
		<i class='fa fa-check icon_button' onclick='editbackpic_edit()'></i>

		<i class='fa fa-times icon_button' onclick='editbackpic_cancel()'></i>

  	</div>
  </li>
  <li class='list-group-item'>leftpic:
  <div class='pull-right'><i class='fa fa-pencil-square-o icon_button' onclick='editleftpic($id)' ></i></div>
  <br>
  <span id='leftpic_area'>
  <img src='$left' style='width:50%;'>
  </span>
  <div class='well well-sm' id='leftpic_area_edit' style='display: none'>
  			<form id='edit_leftpic_form' role='form' enctype='multipart/form-data'>
  				<input type='hidden' name='id' value='$id'></input>
  				 <input type='file' name='left'>
  				
  			</form>
  		
		<i class='fa fa-check icon_button' onclick='editleftpic_edit()'></i>
	
		<i class='fa fa-times icon_button' onclick='editleftpic_cancel()'></i>
	
  	</div>
  </li>
  <li class='list-group-item'>rightpic:
  <div class='pull-right'><i class='fa fa-pencil-square-o icon_button' onclick='editrightpic($id)' ></i></div>
  <br>
  <span id='rightpic_area'>
  <img src='$right' style='width:50%;'>
  </span>
  <div class='well well-sm' id='rightpic_area_edit' style='display: none'>
  			<form id='edit_rightpic_form' role='form' enctype='multipart/form-data'>
  				<input type='hidden' name='id' value='$id'></input>
  				 <input type='file' name='right'>
  				
  			</form>
  		
		<i class='fa fa-check icon_button' onclick='editrightpic_edit()'></i>
	
		<i class='fa fa-times icon_button' onclick='editrightpic_cancel()'></i>
		
  	</div>
  </li>
</ul>";


?>


<script>
function editdeviceid(id)
{
$( "#deviceid_area_edit" ).show( "fast" );
}

function editdeviceid_edit()
{
var formData = new FormData($('#edit_deviceid_form')[0]);
   $.ajax( {
      url: 'editdeviceid.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
		var result = $.trim(data);
	$( "#deviceid_area_edit" ).hide( "fast" );
	$( "#deviceid_area" ).html(result);
		
	//	caradd_update();
	
    }
    } );
    e.preventDefault();
}

function editdeviceid_cancel()
{

$( "#deviceid_area_edit" ).hide( "fast" );
}

function editcarid(id)
{
$( "#carid_area_edit" ).show( "fast" );
}

function editcarid_edit()
{
var formData = new FormData($('#edit_carid_form')[0]);
   $.ajax( {
      url: 'editcarid.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
		var result = $.trim(data);
	$( "#carid_area_edit" ).hide( "fast" );
	$( "#carid_area" ).html(result);
		
	//	caradd_update();
	
    }
    } );
    e.preventDefault();
}

function editcarid_cancel()
{
$( "#carid_area_edit" ).hide( "fast" );
}


function editinfo(id)
{
$( "#info_area_edit" ).show( "fast" );
}

function editinfo_edit()
{
var formData = new FormData($('#edit_info_form')[0]);
   $.ajax( {
      url: 'editinfo.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
		var result = $.trim(data);
	$( "#info_area_edit" ).hide( "fast" );
	$( "#info_area" ).html(result);
		
	//	caradd_update();
	
    }
    } );
    e.preventDefault();
}

function editinfo_cancel()
{
$( "#info_area_edit" ).hide( "fast" );
}

function editfrontpic(id)
{
$( "#frontpic_area_edit" ).show( "fast" );
}

function editfrontpic_edit()
{

var formData = new FormData($('#edit_frontpic_form')[0]);
   $.ajax( {
      url: 'editfrontpic.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
		var result = $.trim(data);
	$( "#frontpic_area_edit" ).hide( "fast" );
	$( "#frontpic_area" ).html("<img src='"+result+"'style='width:50%;'>" );
		
	//	caradd_update();
	
    }
    } );
    e.preventDefault();
}

function editfrontpic_cancel()
{
$( "#frontpic_area_edit" ).hide( "fast" );
}

function editbackpic(id)
{
$( "#backpic_area_edit" ).show( "fast" );
}

function editbackpic_edit()
{

var formData = new FormData($('#edit_backpic_form')[0]);
   $.ajax( {
      url: 'editbackpic.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
		var result = $.trim(data);
	$( "#backpic_area_edit" ).hide( "fast" );
	$( "#backpic_area" ).html("<img src='"+result+"'style='width:50%;'>" );
		
	//	caradd_update();
	
    }
    } );
    e.preventDefault();
}

function editbackpic_cancel()
{
$( "#backpic_area_edit" ).hide( "fast" );
}


function editleftpic(id)
{
$( "#leftpic_area_edit" ).show( "fast" );
}

function editleftpic_edit()
{

var formData = new FormData($('#edit_leftpic_form')[0]);
   $.ajax( {
      url: 'editleftpic.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
		var result = $.trim(data);
	$( "#leftpic_area_edit" ).hide( "fast" );
	$( "#leftpic_area" ).html("<img src='"+result+"'style='width:50%;'>" );
		
	//	caradd_update();
	
    }
    } );
    e.preventDefault();
}

function editleftpic_cancel()
{
$( "#leftpic_area_edit" ).hide( "fast" );
}

function editrightpic(id)
{
$( "#rightpic_area_edit" ).show( "fast" );
}

function editrightpic_edit()
{

var formData = new FormData($('#edit_rightpic_form')[0]);
   $.ajax( {
      url: 'editrightpic.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
		var result = $.trim(data);
	$( "#rightpic_area_edit" ).hide( "fast" );
	$( "#rightpic_area" ).html("<img src='"+result+"'style='width:50%;'>" );
		
	//	caradd_update();
	
    }
    } );
    e.preventDefault();
}

function editrightpic_cancel()
{
$( "#rightpic_area_edit" ).hide( "fast" );
}

$(function() {
$("#pull_car").click(function(){
var carid = $("#pull_car_id").val();
var dataString = 'carid='+ carid;
$.ajax({
 type: "POST",
  url: "pulldriver.php",
  datatype: "html",
  data: dataString,
  success: function(data) {
  $('#info_text_area').val(data);
  }});
})})


function editdriverpic(id)
{
$( "#driverpic_area_edit" ).show( "fast" );
}

function editdriverpic_edit()
{

var formData = new FormData($('#edit_driverpic_form')[0]);
   $.ajax( {
      url: 'editdriverpic.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
		var result = $.trim(data);
	$( "#driverpic_area_edit" ).hide( "fast" );
	$( "#driverpic_area" ).html("<img src='"+result+"'style='width:50%;'>" );
		
	//	caradd_update();
	
    }
    } );
    e.preventDefault();
}

function editdriverpic_cancel()
{
$( "#driverpic_area_edit" ).hide( "fast" );
}




</script>