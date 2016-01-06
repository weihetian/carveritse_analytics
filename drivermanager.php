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
    <title>Driver Manager</title>
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
 	<nav class="navbar navbar-default  navbar-fixed-top" role="navigation">
   	
   	<a class="navbar-brand" href="#">
   	 <span class='nav-car'>car</span><span class="nav-ver">vertise</span>
    	<span class='nav-analytics'>Analytics</span>
   	</a>
 	
 	<ul class="nav navbar-nav">
        <li ><a href="manager.php" style='color:white;'>Campagin Manager</a></li>
        <li style="background-color:#6199AE;" ><a href="#"  style="height:40px;color:white;">Driver Manager</a></li>
    </ul>
  
   	 <a class="pull-right " href="sign_out.php">Sign out</a>  
   	</nav>
   	
   	<div class="main">
		<div class="main_container">
			<div class="col-md-3" id='driverlist'>
				<h4>
				<div class="btn-group btn-group-justified">
					<div class="btn-group">
						<button type="button" class="btn btn-default" id="performance_btn" onclick='performance()'>Statistics</button>
					</div>
					 <div class="btn-group ">
						<button type="button" class="btn btn-default" id="compare_btn" onclick='compare()'>Compare</button>
					</div>
					 <div class="btn-group ">
						<button type="button" class="btn btn-default" onclick='aggregate()'>Aggregate</button>
					</div>
				</div>
				
				</h4>
				
				<div id='drivermanager_driverlist'>
				
				
				</div>
			</div>
			<div class="col-md-9" id='dashborad'>
			
			</div>
		</div>
	</div>
   	
</body>

</html>

<script>
var selected = 0;

function performance()
{

    $("#compare_btn").removeClass('active');
  $("#compare_btn").removeClass('selected');
selected = 1;
	$("#performance_btn").addClass('active');
   $("#performance_btn").addClass('selected');
}

function compare()
{
    $("#performance_btn").removeClass('active');
  $("#performance_btn").removeClass('selected');
selected = 2;
	$("#compare_btn").addClass('active');
   $("#compare_btn").addClass('selected');
}

var num = 0;

function selectdriver(id,cid)
{
//alert(name);
	if(selected == 1){
	$("#dashborad").html("");
	$("#dashborad").load('driverperformance.php?deviceid='+id+'&campaignid='+cid);
	}else if(selected == 2)
	{
		if(num == 0){
			$("#dashborad").html("");
			$("#dashborad").load('drivercompare.php?deviceid='+id+'&campaignid='+cid);
			num++;
		}else
		{
		num++;
		adddriver(id,cid);
		
		}
	}
}

$(function() {
	$("#drivermanager_driverlist").load('alldriverlist.php');
});




</script>
   	