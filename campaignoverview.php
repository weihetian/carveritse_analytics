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
	
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css"></link>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  
<script src="js/jquery.transit.min.js"></script>

</head>
<body>
	
	
</body>
</html>