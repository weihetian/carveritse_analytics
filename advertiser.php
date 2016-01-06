<?php
	session_start();
   //Read your session (if it is set)
   if (isset($_SESSION['admin']))
	{
      if( $_SESSION['admin']!="advertiser" &&  $_SESSION['admin']!="admin")
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


			$name = $_SESSION['campaign_name'];
			$id=$_SESSION['campaign_id'];

$result = mysqli_query($con,"SELECT * FROM campaign WHERE id = $id")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result)) {
		$start = $row['start'];
		$end = $row['end'];					
}



?>
<html>
<head>
    <meta charset="utf-8"></meta>
    <meta http-equiv="Content-Type" content="text/html"></meta>
    <title>Campaign</title>
	<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
	 <link href="css/bootstrap.min.css" rel="stylesheet"></link>
        
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

           <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"></link>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=visualization"></script>
        <script type="text/javascript">
            // When the window has finished loading create our google map below
         
        </script>
        
        <script src="js/Chart.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css"></link>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  
<script src="js/jquery.transit.min.js"></script>

	<link href="css/_admin.css" rel="stylesheet"></link>
</head>
<body>
 	<nav class="navbar navbar-default  navbar-fixed-top" role="navigation">
   	
   	<a class="navbar-brand" href="#">
   	 <span class='nav-car'>car</span><span class="nav-ver">vertise</span>
    	<span class='nav-analytics'>Analytics</span>
   	</a>
 	
  
   	 <a class="pull-right " href="sign_out.php">Sign out</a>  
   	</nav>
   	

<div class="main">
	<div class="main_container">
<!-- 
			<div class="col-md-2" id="left_summary">
			<?php
					echo "<h4><small>Campaign name:</small> <br> $name</h4>
					";
					echo "
					<h4><small>Date:</small><br>  $start </h4>
					";
					?>
					<h4><small>Drivers:</small></br> 20</h4>
					
					<h4><small>Total Impressions:</small></br> 1992600</h4>
					<h4><small>Average Impressions:</small></br> 3321 <small>/day/driver</small></h4>
					<h4><small>Total Miles:</small></br> 31800</h4>
					<h4><small>Average Miles:</small> </br>53 <small>/day/driver</small></h4>
			</div>
 -->
			<div class="col-md-3" id='carlist'>
			
			<h3><i class="fa fa-users"></i>Drivertisers</h3>
			<div class='btn-group-justified'>
			 <div class="btn-group ">
			<button type="button" class="btn btn-default" onclick='aggregate()'><i class="fa fa-sitemap fa-lg"></i>Aggregate</button>
			</div>
			</div>
			</br>
			<div class='carlist_area'>
 				   <?php


$result = mysqli_query($con,"SELECT * FROM device WHERE campaignid = '$id'")or die("Error: ".mysqli_error($con));

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
		$front = $row['front'];	
		$back = $row['back'];	
		$left = $row['leftpic'];	
		$right = $row['rightpic'];		
		echo "<div class='panel panel-default a_car' id='a_car$id' style='cursor:pointer;' onclick='showprofile($id,$deviceid)'>
			<div>
				<div class='col-md-7' >$driver</div>
				<div class='col-md-5'><img src='$left' style='max-width:80px;max-height:55px;box-shadow: 0px 1px 5px #888888;'></div>
				</div>
				 <div class='row profile' id='profile$id'>
				 	
				 </div>
				
				</div>
				
				
				";
		}


?>	
			</div>
			</div>
			<div class="col-md-9" id="right_dashborad">
				<div id='dashborad'>
				
				</div>
			</div>
		</div>
</div>

	<div class='middle_layer'>
		
	</div>
   	
</body>
</html>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<script>

$(document).ready(function() {
$( "#left_summary" ).resizable({   handles: 'e'    
    });
});


$(function() {
   $("#dashborad").load('summary.php');
  });
  
function aggregate()
{
	 $("#a_car"+selected).css({ boxShadow: '0px 0px 0px #888888' });
// 	  $("#a_car"+selected).css({ 'background-color': '#F8F8F8'});
//  $("#a_car"+selected).css({ 'border-color': '#D8D8D8'});
	 $("#a_car"+selected).transition({ marginTop: '10px' });
	 $("#a_car"+selected).transition({ marginBottom: '10px' });
selected = 0;
 $("#dashborad").load('summary.php');
 
}
  
var selected;
  
function showprofile(id,deviceid)
{
//$("#campaignsinglecar_area").html("");	
 $("#dashborad").html("");
 $("#a_car"+selected).css({ boxShadow: '0px 0px 0px #888888' });
 
//  $("#a_car"+selected).css({ 'background-color': '#F8F8F8'});
//  $("#a_car"+selected).css({ 'border-color': '#D8D8D8'});
	 $("#a_car"+selected).transition({ marginTop: '10px' });
	 $("#a_car"+selected).transition({ marginBottom: '10px' });
selected = id;
 $("#dashborad").load('singlesummary.php?id='+id+'&deviceid='+deviceid);
 $("#a_car"+id).css({ boxShadow: '0px 10px 10px #888888' });
//  $("#a_car"+id).css({ 'background-color': 'rgba(97,153,174,0.5)'});
//  $("#a_car"+id).css({ 'border-color': 'rgba(97,153,174,0.5)'});
 $("#a_car"+id).transition({ marginTop: '30px' });
 $("#a_car"+id).transition({ marginBottom: '30px' });
//  	var height;
// 	height=$("#profile"+id).height();
// 	if(height==0){
// 	  //$("#dashborad").load('singlesummary.php?id='+deviceid);
// $("#profile"+id).transition({ height: 200 }).load('driver_profile.php?id='+id);
// }else
// {
// $("#profile"+id).transition({ height: 0 });
// $("#profile"+id).html('');
// }
}
  
  
// $(document).ready(function() {
//     $("#dashborad").transition({ x: 200 });
// });
</script>