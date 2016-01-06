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
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html">
    <title>Console</title>
	<link href="css/_admin.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
	       <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

        
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=visualization"></script>
        <script type="text/javascript">
            // When the window has finished loading create our google map below
         
        </script>
        
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>
<body>
 	<nav class="navbar navbar-default  navbar-fixed-top" role="navigation">
   	
   	<a class="navbar-brand" href="#">
   	 <span class='nav-car'>car</span><span class="nav-ver">vertise</span>
    	<span class='nav-analytics'>Analytics</span>
   	</a>
 	
 	<ul class="nav navbar-nav">
        <li class="active"><a href="console.php">Console</a></li>
        <li><a href="#">Report</a></li>
    </ul>
  
   	 <a class="pull-right " href="sign_out.php">Sign out</a>  
   	</nav>
   	


<div class="main">
	<div class="container">
	
		<div class="panel panel-default">
  			<!-- Default panel contents -->
 			 <div class="panel-heading"><h3>Campaigns <a class="btn pull-right btn-primary" href='javascript:void(0)' onclick='add()'><i class="fa fa-plus"></i>Create Campaigns</a></h3></div>

 				 <!-- Table -->
 				 <table class="table table-hover">
 				   	<tr class='info'>
							<th class="col-md-1">id</th>
							<th class="col-md-2">name</th>
							<th class="col-md-2">advertise</th>
							<th class="col-md-1">start</th>
							<th class="col-md-1">end</th>
							</tr>
							<?php
							
							$result = mysqli_query($con,"SELECT * FROM campaign")or die("Error: ".mysqli_error($con));

							while($row = mysqli_fetch_array($result)) {
								echo "<tr class='clickableRow'  href='campaign.php?id=".$row['id']."&name=".$row['name']."'> 
										<td>".$row['id']."</td>
										<td>".$row['name']."</td>
										<td>".$row['account']."</td>
										<td>".$row['start']."</td>
										<td>".$row['end']."</td>
										</tr>";
							}

							
							?>
							
					
  				</table>
		</div>
	</div>
</div>
<div class='modal fade' id='addModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
							<h4 class='modal-title ' id='myModalLabel'>Create campaign</h4>
			</div>
			<div class='modal-body '>
			
			<form role="form" action="create.php" method="post">
 				 <div class="form-group">
				    <label for="campaignName">Campaign name</label>
				    <input type="input" class="form-control" id="campaignName" name="name" placeholder="Enter name">
				  </div>
				  <div class="form-group">
				    <label for="advertiserName">Advertise account</label>
				    <input type="input" class="form-control" id="advertiserName" name="account" placeholder="Enter account name">
				  </div>
				  
				  <div class="form-group">
				    <label for="advertiserPassword">Password</label>
					<input type="input" class="form-control" id="advertiserPassword" name="password" placeholder="Password">
				  </div>
				  
				   <div class="form-group well well-sm">
				    <label for="advertiserPassword">Time Interval</label>
				    
						<p>Start <input type="text" name="start" id="startdatepicker">  End <input type="text" name="end" id="enddatepicker"></p> 
				
					</div>
				  
				  
				  
				  <button type="submit" class="btn btn-default">Submit</button>
				  
				</form>
			
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
					</div>
			</div>
	</div>
</div>


<script src="js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">

jQuery(document).ready(function($) {
      $(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      });
});


$(function() {
    $( "#startdatepicker" ).datepicker();
  });$(function() {
    $( "#enddatepicker" ).datepicker();
  });
function add(){
$('#addModal').modal('show')
}

</script>

</body>
</html>