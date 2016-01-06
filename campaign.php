<?php
	session_start();
   //Read your session (if it is set)
   if (isset($_SESSION['admin']))
	{
      if( $_SESSION['admin']!="admin")
	  {
	  header('Location: index.html');
	  }
	  }else
	  {
	  header('Location: index.html');
	  }
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


			$name = $_GET['name'];
			$id=$_GET['id'];

$result = mysqli_query($con,"SELECT * FROM campaign WHERE id = $id")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result)) {
		$start = $row['start'];
		$end = $row['end'];					
}



?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <title>Campaign</title>
	<link href="css/_admin.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
        
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

           <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=visualization"></script>
        <script type="text/javascript">
            // When the window has finished loading create our google map below
         
        </script>
        <script src="js/Chart.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
</head>
<body>
 	<nav class="navbar navbar-default  navbar-fixed-top" role="navigation">
   	
   	<a class="navbar-brand" href="#">
   	 <span class='nav-car'>car</span><span class="nav-ver">vertise</span>
    	<span class='nav-analytics'>Analytics</span>
   	</a>
 	
 	<ul class="nav navbar-nav">
        <li ><a href="console.php#">Console</a></li>
        <li class="active"><a href="#">Report</a></li>
    </ul>
  
   	 <a class="pull-right " href="sign_out.php">Sign out</a>  
   	</nav>
<div class="main">
	<div class="campaign_left">
			<div class="well">
				<ul class="nav nav-pills nav-stacked" id="myTab">
					<li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-home fa-lg"></i>Home</a></li>
					<li id='devicesTab'><a href="#devices" data-toggle="tab"><i class="fa fa-users fa-lg"></i>Drivers</a></li>
					<li id='chartsTab'><a href="#charts" data-toggle="tab"><i class="fa fa-line-chart fa-lg"></i>Charts</a></li>
					<li id='mapsTab'><a href="#maps" data-toggle="tab"><i class="fa fa-map-marker fa-lg"></i>Maps</a></li>
					<li><a href="#edit" data-toggle="tab"><i class="fa fa-info fa-lg"></i>EditInfo</a></li>
				</ul>
			</div>
		</div>
	<div class="container campaign_right">
		<!-- 
<div class="page-header">
			<?php
			echo "
			<h1>$name <span class='label label-info'>Campaign</span></h1>
			";
			?>
		</div>
 -->
		
		
		
		<div class=" col-xs-10 col-md-10 col-md-offset-2">
			<div class="tab-content">
 			 <div class="tab-pane fade in active" id="home">
 			 	<div class="panel panel-default">
  <div class="panel-heading"><h3>Summary</h3></div>
  <div class="panel-body">
 			 		<?php
					echo "
					<h2><small>Campaign name:</small>  $name</h2>
					";
					echo "
					<h2><small>Time Interval:</small>  $start <small>to</small> $end</h2>
					";
					?>
					<h2><small>Drivers:</small> 5</h2>
					
					<h2><small>Total Impressions:</small> 82212</h2>
					<h2><small>Average Impressions:</small> 3321 <small>/day</small></h2>
					<h2><small>Total Miles:</small> 43220</h2>
					<h2><small>Average Miles:</small> 403 <small>/day</small></h2>
 			 </div>
 			 </div>
 			 </div>
 			 <div class="tab-pane fade" id="devices">
 			 	
 			 
 			 </div>
 			 <div class="tab-pane fade" id="charts">
 			 
 			 </div>
 			 <div class="tab-pane fade" id="maps">
 			 
 			 </div>
  			<div class="tab-pane fade" id="edit">...</div>
			</div>
		
		</div>
	
	</div>
</div>

<div class='modal fade' id='addModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
							<h4 class='modal-title ' id='myModalLabel'>Add device</h4>
			</div>
			<div class='modal-body '>
			
			<form id="upload_form" role="form" enctype="multipart/form-data">
			<?php
				 echo "<input type='hidden' id='campaignid' name='campaignid' value=".$id." />";
				 
				 ?>
 				 <div class="form-group">
				    <label for="deviceId">Device id</label>
				    <input type="input" class="form-control" id="deviceId" name="deviceid" placeholder="Enter device id"></input>
				  </div>
				  <div class="form-group">
				    <label for="deviceId">Car id</label>
				    <input type="input" class="form-control" id="carId" name="carid" placeholder="Enter car id"> </input> 
				    <div id="pullCarInfo" style='margin-top:10px;'class="btn btn-primary btn-sm">Pull Car Info</div>
				  </div>
				   	<div class="form-group">
				    <label for="driver">Driver Name</label>
				    <input type="input" class="form-control" id="driver" name="driver" placeholder="Enter device name"></input>
				  </div>
				  <div class="form-group">
				    <label for="devicelabel">Info</label>
				    <textarea class="form-control" id="info" rows="4" name="info"></textarea>
				  </div>
				  <div class="form-group">
   					 <label for="front">Front picture</label>
   					 <input type="file" id="front" name="front">
  					</div>
  					<div class="form-group">
   						 <label for="back">Back picture</label>
  						  <input type="file" id="back" name="back">
 						 </div>
				  <div class="form-group">
						<label for="left">Left picture</label>
						<input type="file" id="left" name="left">
				  </div>
				  <div class="form-group">
						<label for="right">Right Picture</label>
						<input type="file" id="right" name="right">
				  </div>
				  
				  <div id="submit" class="btn btn-default">Submit</div>
				  
				</form>
			
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
					</div>
			</div>
	</div>
</div>

<div class='modal fade' id='editModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
							<h4 class='modal-title ' id='myModalLabel'>Discription</h4>
			</div>
			<div class='modal-body'>
			
			<form id="edit_form" role="form" enctype="multipart/form-data">
			<?php
				 echo "<input type='hidden' id='campaignid' name='editcampaignid' value=".$id." />";
				 
				 ?>
				 <input type='hidden' id='editid' name='editid' />
 				 <div class="form-group">
				    <label for="deviceId">Device id</label>
				    <input type="input" class="form-control" id="editdeviceId" name="editdeviceid" placeholder="Enter device id"></input>
				  </div>
				  <div class="form-group">
				    <label for="deviceId">Car id</label>
				    <input type="input" class="form-control" id="editcarId" name="editcarid" placeholder="Enter car id"> </input> 
				    <div id="editpullCarInfo" style='margin-top:10px;'class="btn btn-primary btn-sm">Pull Car Info</div>
				  </div>
				  
				   <div class="form-group">
				    <label for="driver">Driver name</label>
				    <input type="input" class="form-control" id="editdriver" name="editdriver" placeholder="Enter driver name"></input>
				  </div>
				  
				  <div class="form-group">
				    <label for="devicelabel">Info</label>
				    <textarea class="form-control" id="editinfo" rows="4" name="editinfo"></textarea>
				  </div>
				  
				  <div class="form-group">
				    <label for="devicelabel">Pic</label>
				  <div class='picarea'>
				  
				  </div>
				  </div>
				  
				  <div class="form-group">
   					 <label for="front">Front picture</label>
   					 <input type="file" id="editfront" name="editfront">
  					</div>
  					<div class="form-group">
   						 <label for="back">Back picture</label>
  						  <input type="file" id="editback" name="editback">
 						 </div>
				  <div class="form-group">
						<label for="left">Left picture</label>
						<input type="file" id="editleft" name="editleft">
				  </div>
				  <div class="form-group">
						<label for="right">Right Picture</label>
						<input type="file" id="editright" name="editright">
				  </div>
				  
				  <div id="editsubmit" class="btn btn-default">Submit</div>
				  
				</form>
				
			 
										
			</div>
			
			
			<div class='modal-footer'>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
					</div>
			</div>
	</div> 
</div>

		
<script src="js/bootstrap.min.js"></script>

<script>
$(function() {
    $( document ).tooltip();
  });
  

// $(".toolimage").tooltip({ content: '<img src="'+$(this).prop('title')+.'" />' });

$.widget("ui.tooltip", $.ui.tooltip, {
    options: {
    position: {
        my: "center bottom-0",
        at: "center top"
    },
        content: function () {
            return $(this).prop('title');
        }
    }
});


function add(){
$('#addModal').modal('show');
}

$('#devicesTab').on('show.bs.tab', function (e) {
var campaignid = $("#campaignid").val();
  $("#devices").load('deviceslist.php?id='+campaignid);
  
})

$('#mapsTab').on('show.bs.tab', function (e) {

var campaignid = $("#campaignid").val();
  $("#maps").load('maps.php');
  
})

$('#chartsTab').on('show.bs.tab', function (e) {

var campaignid = $("#campaignid").val();
  $("#charts").load('charts.php?id='+campaignid);
  
})


$(function() {
$("#pullCarInfo").click(function(){
var carid = $("#carId").val();
var dataString = 'carid='+ carid;
$.ajax({
 type: "POST",
  url: "pulldriver.php",
  datatype: "html",
  data: dataString,
  success: function(data) {
  $('#info').val(data);
  }});
  

})
});


$(function() {
$("#submit").click(function() {
  var campaignid = $("#campaignid").val();
var deviceid = $("#deviceId").val();
var carid = $("#carId").val();
var driver = $("#driver").val();
var info = $("#info").val();
var front = $("#front").val();
var back = $("#back").val();
var left = $("#left").val();
var right = $("#right").val();
if(deviceid=='' || driver==''|| campaignid=='')
{
alert("please enter all the info");
}
else
{
var formData = new FormData($('#upload_form')[0]);
   $.ajax( {
      url: 'adddevice.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
	if($.trim(data)=="succeed")
	{
		alert("succeed");
		$('#addModal').modal('hide');
		var campaignid = $("#campaignid").val();
  $("#devices").load('deviceslist.php?id='+campaignid);
  
	}else{
    alert(data);}
    }
    } );
    e.preventDefault();
  }} );
  
  });

// $(function() {
// 
// 
// $("#submit").click(function() {
// var campaignid = $("#campaignid").val();
// var deviceid = $("#deviceId").val();
// var carid = $("#carId").val();
// var info = $("#info").val();
// var front = $("#front").val();
// var back = $("#back").val();
// var left = $("#left").val();
// var right = $("#right").val();
// var dataString = 'deviceid='+ deviceid+'&carid='+ carid + '&campaignid=' + campaignid + '&info=' + info+ '&front=' + front+ '&back=' + back+ '&left=' + left+ '&right=' + right;
// 
// if(deviceid=='' || carid==''|| campaignid==''|| info=='')
// {
// alert("please check your info");
// }
// else
// {
// $.ajax({
//  type: "POST",
//   url: "adddevice.php",
//   datatype: "html",
//   data: dataString,
//   success: function(data) {
// 	if($.trim(data)=="succeed")
// 	{
// 		alert("succeed");
// 		$('#addModal').modal('hide');
// 		var campaignid = $("#campaignid").val();
//   $("#devices").load('deviceslist.php?id='+campaignid);
//   
// 	}else{
//     alert(data);}
//     }
// });
// }
// return false;
// });
// });
</script>

</body>
</html>