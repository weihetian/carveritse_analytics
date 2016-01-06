  <div class="panel panel-default">
   
     <div class="panel-heading">
<?php
$campaignid=$_GET['id'];
echo"<h2>Devices <a class='btn btn-primary' href='viewallcars.php?id=$campaignid'>View All</a> <a class='btn pull-right btn-primary' href='javascript:void(0)' onclick='add()'>add</a></h2>";
?>

</div>

	 <div class="panel-body">
 			  <table class="table table-hover">
 				   	<tr class='info'>
							<th class="col-md-1">device id</th>
							<th class="col-md-1">car id</th>
							<th class="col-md-1">driver name</th>
							<th class="col-md-1">info</th>
							<th class="col-md-1">front</th>
							<th class="col-md-1">back</th>
							<th class="col-md-1">left</th>
							<th class="col-md-1">right</th>
							<th class="col-md-1">edit</th>
							<th class="col-md-1">delete</th>
							</tr>
  			
<?php
$con= mysqli_connect("analytics.carvertise.com", "stak_scott", "t87565342","carvertise_analytics");
 
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM device WHERE campaignid = $campaignid")or die("Error: ".mysqli_error($con));

		while($row = mysqli_fetch_array($result)) {
		$id = $row['id'];
		$deviceid = $row['deviceid'];
		$carid = $row['carid'];
		$drivername = $row['drivername'];
		$rawinfo = $row['info'];
		
		$dinfo = str_replace(array("'"), " ", $rawinfo); 
		$dinfo = str_replace(array('\r\n', '\r', '\n'), "\n", $dinfo);
		
		$info = str_replace(array('\r\n', '\r', '\n'), "<br />", $rawinfo); 
		$info = str_replace(array("'"), " ", $info); 
		$front = $row['front'];	
		$back = $row['back'];	
		$left = $row['leftpic'];	
		$right = $row['rightpic'];		
		echo "<tr'>
				<td><div class='hidden' id='deviceid$id' value='$deviceid'></div>".$deviceid."</td>
				<td><div class='hidden' id='carid$id' value='$carid'></div>".$carid."</td>
				<td><div class='hidden' id='driver$id' value='$drivername'></div>".$drivername."</td>
				<td><div class='hidden' id='info$id' value='$dinfo'></div><a class='tool' href='javascript:void(0);' title='$info'>(view)</a></td>
				<td><div class='hidden' id='front$id' value='$front'></div><a class='toolimage' href='javascript:void(0);'  value='$front'><img src='$front' style='width:80px;'></a></td>
				<td><div class='hidden' id='back$id' value='$back'></div><a class='toolimage' href='javascript:void(0);' value='$back'><img src='$back' style='width:80px;'></a></td>
				<td><div class='hidden' id='left$id' value='$left'></div><a class='toolimage' href='javascript:void(0);' value='$left'><img src='$left' style='width:80px;'></a></td>
				<td><div class='hidden' id='right$id' value='$right'></div><a class='toolimage' href='javascript:void(0);' value='$right'><img src='$right' style='width:80px;'></a></td>
				<td><button class='edit_btn btn btn-primary ' value='$id'>edit</button></td>
				<td><button class='delete_btn btn btn-danger' value='$id'>delete</button></td>
				</tr>
				";
		}


?>	


</table>
</div>
</div>


<div class='modal fade' id='viewModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
							<h4 class='modal-title ' id='myModalLabel'>Picture</h4>
			</div>
			<div class='modal-body viewBody'>
			
			
				</dvi>
			<div class='modal-footer'>
				<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
					</div>
			</div>
	</div>
</div>

</div>




<script type='text/javascript'> 


$('.toolimage').click(function (e) { 

var content='';
		var src= $(this).attr("value"); 
        content+="<img src='"+src+"' alt='...' width='400'>";
	$(".viewBody").html(content);
  $('#viewModal').modal('show');
})

$('.edit_btn').click(function(e){ 
	var id= $(this).attr("value");
	var deviceid= $("#deviceid"+id).attr("value"); 
	var carid= $("#carid"+id).attr("value");
	var driver= $("#driver"+id).attr("value");
	var info= $("#info"+id).attr("value"); 
	var front= $("#front"+id).attr("value"); 
	var back= $("#back"+id).attr("value");
	var left= $("#left"+id).attr("value"); 
	var right= $("#right"+id).attr("value");
	
	
	$('#editdeviceId').val(deviceid);
	$('#editcarId').val(carid);
	$('#editdriver').val(driver);
	$('#editinfo').val(info);
	$('#editid').val(id);

	var content='';
	 content+="front:<img src='"+front+"' alt='...' width='100'> ";
	 content+="back:<img src='"+back+"' alt='...' width='100'> ";
	 content+="left:<img src='"+left+"' alt='...' width='100'> ";
	 content+="right:<img src='"+right+"' alt='...' width='100'> ";
	$('.picarea').html(content);
 $('#editModal').modal('show');
});

$('.delete_btn').click(function(e){ 
	var id= $(this).attr("value");
	var dataString = 'deleteid='+ id;
$.ajax({
 type: "POST",
  url: "deletedevice.php",
  datatype: "html",
  data: dataString,
  success: function(data) {
  
	var campaignid = $("#campaignid").val();
  $("#devices").load('deviceslist.php?id='+campaignid);
  }});
});


$(function() {
$("#editpullCarInfo").click(function(){
var carid = $("#editcarId").val();
var dataString = 'carid='+ carid;
$.ajax({
 type: "POST",
  url: "pulldriver.php",
  datatype: "html",
  data: dataString,
  success: function(data) {
  $('#editinfo').val(data);
  }});
})
});

$(function() {
$("#editsubmit").click(function() {
  var campaignid = $("#editcampaignid").val();
var deviceid = $("#editdeviceId").val();
var carid = $("#editcarId").val();
var driver = $("#editdriver").val();
var info = $("#editinfo").val();
if(deviceid=='')
{
alert("please enter all the info");
}
else
{
var formData = new FormData($('#edit_form')[0]);
   $.ajax( {
      url: 'editdevice.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
	if($.trim(data)=="succeed")
	{
		alert("succeed");
		$('#editModal').modal('hide');
		var campaignid = $("#campaignid").val();
  $("#devices").load('deviceslist.php?id='+campaignid);
  
	}else{
    alert(data);}
    }
    } );
    e.preventDefault();
  }} );
  
  });

</script>