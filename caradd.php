
<?php

$campaignid=$_GET['id'];
echo "

<div class='well'>

<form id='upload_car_form' role='form' enctype='multipart/form-data'>
<input type='text' name='drivername' class='form-control' placeholder='Driver name'></input>
<input type='hidden' name='campaignid' value='$campaignid'></input>
</form>
</br>

<div class='row'>
<div class='col-md-6'>
<button type='button' class='btn btn-primary' onclick='add_car()'><i class='fa fa-check'></i></button>
</div>
<div class='col-md-6'>
<button type='button' class='btn btn-primary' onclick='addcar_cancel()'><i class='fa fa-times'></i></button>
</div>
</div>
</div>";


?>
<script>

function add_car()
{
var campaignid = $("#carlistcampaignid").val();
var formData = new FormData($('#upload_car_form')[0]);
   $.ajax( {
      url: 'adddriver.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
	if($.trim(data)=="succeed")
	{
		caradd_update();
	}else{
    alert(data);}
    }
    } );
    e.preventDefault();
  }

</script>