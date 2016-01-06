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





?>
<html>
<head>
    <meta charset="utf-8"></meta>
    <meta http-equiv="Content-Type" content="text/html"></meta>
    <title>Campaign Manager</title>
	<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
	 <link href="css/bootstrap.min.css" rel="stylesheet"></link>
        
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

           <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"></link>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=visualization"></script>
        <script type="text/javascript">
            // When the window has finished loading create our google map below
         
        </script>
        <link href="css/_admin.css" rel="stylesheet"></link>
	
        
        <script src="js/Chart.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css"></link>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  
<script src="js/jquery.transit.min.js"></script>

</head>
<body>
 	<nav class="navbar navbar-default  navbar-fixed-top" role="navigation" >
   	
   	<a class="navbar-brand" href="#">
   	 <span class='nav-car'>car</span><span class="nav-ver">vertise</span>
    	<span class='nav-analytics'>Analytics</span>
   	</a>
 	
 	<ul class="nav navbar-nav" >

		 <li style="background-color:#6199AE;"><a href="campaignoverview.php" style="height:40px;color:white;">Campaign overview</a></li>
        <li style="height:40px;"><a href="#" style="color:white;">Campagin Manager</a></li>
        <li style="height:40px;"><a href="drivermanager.php" style="color:white;">Driver Manager</a></li>
    </ul>
  
   	 <a class="pull-right " href="sign_out.php">Sign out</a>  
   	</nav>
   	

<div class="main">
	<div class="main_container">
		<div class="col-md-3" id='campaignlist'>
			
			<h3>Campaigns <div class="pull-right"><button type="button" class="btn btn-primary" onclick='createcampaign()'><i class="fa fa-plus-circle"></i></button></div></h3>
			
			<div id="campaigncreate_area">
			
			</div>
			
			<div id="campaignlist_area">
			
			</div>
		</div>
		
		<div class="col-md-3" id='campaigncarlist'>
			
			
			<div id="campaigncarlist_area">
			
			</div>
		
		</div>
		
		<div class="col-md-6" id='campaignsinglecar'>
			<h3>Car Info</h3>
			
			<div id="campaignsinglecar_area">
			
			</div>
		
		</div>
		
	</div>
</div>
</body>
</html>


<script>

var selected;
var selectedcar;

$(function() {
   $("#campaignlist_area").load('campaignlist.php');
  });
  
function createcampaign()
{
 $("#campaigncreate_area").load('campaigncreate.php');
} 


function createcampaign_cancel()
{
   $("#campaigncreate_area").html("");
}

function createcampaign_update()
{
$("#campaigncreate_area").html("");
$("#campaignlist_area").load('campaignlist.php');
}




function deletecampaign(id)
{
	var dataString = 'deleteid='+ id;
    if (confirm("Are you sure you want to delete this campaign?") == true) {
        $.ajax({
 type: "POST",
  url: "deletecampaign.php",
  datatype: "html",
  data: dataString,
  success: function(data) {
  
		$("#campaignlist_area").load('campaignlist.php');
  }});
    } else {
        
    }
}
  
function showcars(id)
{

$("#campaignsinglecar_area").html("");	
 $("#a_campaign"+selected).css({ boxShadow: '0px 0px 0px #888888' });
	 $("#a_campaign"+selected).transition({ marginTop: '0px' });
	 $("#a_campaign"+selected).transition({ marginBottom: '0px' });
selected = id;
 $("#campaigncarlist_area").load('campaigncarlist.php?id='+id);
 $("#a_campaign"+id).css({ boxShadow: '0px 10px 10px #888888' });
 $("#a_campaign"+id).transition({ marginTop: '30px' });
 $("#a_campaign"+id).transition({ marginBottom: '30px' });
 
}

function caradd_update()
{
 $("#campaigncarlist_area").load('campaigncarlist.php?id='+selected);
}

function showcampaigncar(id)
{
$("#campaignsinglecar_area").html("");	
$("#a_campaign_car"+selectedcar).css({ boxShadow: '0px 0px 0px #888888' });
	 $("#a_campaign_car"+selectedcar).transition({ marginTop: '0px' });
	 $("#a_campaign_car"+selectedcar).transition({ marginBottom: '0px' });
	selectedcar = id;
	$("#campaignsinglecar_area").load('campaignsinglecar.php?id='+id);
	$("#a_campaign_car"+id).css({ boxShadow: '0px 5px 5px #888888' });
 $("#a_campaign_car"+id).transition({ marginTop: '20px' });
 $("#a_campaign_car"+id).transition({ marginBottom: '20px' });
	//alert('campaignsinglecar.php?id='+id+"&deviceid="+deviceid);
}

</script>