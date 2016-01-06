<div class="well">

<form id="upload_form" role="form" enctype="multipart/form-data">
<input type="text" name='campaignname' class="form-control" placeholder="Campaign name"></input>
</br>
<input type="text" name='advertisername' class="form-control" placeholder="Advertiser name"></input>
</br>
<input type="text" name='advertiserpassword' class="form-control" placeholder="Advertiser password"></input>
</br>
<input type="text" name="campaignstart" class="form-control" id="startdatepicker"  placeholder="Start Date"></input>
</br>
<input type="text" name="campaignend"  class="form-control"id="enddatepicker" placeholder="End Date"></input>
</form>
</br>

<div class='row'>
<div class="col-md-6">
<button type="button" class="btn btn-primary" onclick='createcampaign_create()'><i class="fa fa-check"></i></button>
</div>
<div class="col-md-6">
<button type="button" class="btn btn-primary" onclick='createcampaign_cancel()'><i class="fa fa-times"></i></button>
</div>
</div>
</div>
<script>
$(function() {
    $( "#startdatepicker" ).datepicker();
  });$(function() {
    $( "#enddatepicker" ).datepicker();
  });

function createcampaign_create()
{

var formData = new FormData($('#upload_form')[0]);
   $.ajax( {
      url: 'create.php',
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
	if($.trim(data)=="succeed")
	{
		createcampaign_update();
	}else{
    alert(data);}
    }
    } );
    e.preventDefault();
  }

</script>