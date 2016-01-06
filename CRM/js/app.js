


(function(){
	var app = angular.module('crm',[]);

  app.directive('pageLeft',function(){
	  return{
		  templateUrl:"leftbar.html"
	  }
  });
  app.directive('pageMain',function(){
	  return{
		  templateUrl:"main.html"
	  }
  });
  
  app.controller("CampaignController",function($scope){
  	
	var dataString;

  	$.ajax({
  	 type: "POST",
  	  url: "data_access/load_all_campaigns.php",
  	  datatype: "html",
  	  data: dataString,
  	    success: function(data) {
  	  	var campaigns  = $.parseJSON(data);
		$scope.campaigns = campaigns;

		$scope.$digest();
	}
});


	
$scope.campaign_analytics = function(id)
{
	var dataString="campaignid="+id;

  	$.ajax({
  	 type: "POST",
  	  url: "data_access/access_campaign.php",
  	  datatype: "html",
  	  data: dataString,
  	    success: function(data) {
			if($.trim(data)=="succeed")
			{
				var win = window.open('http://www.carvertise.com/analytics/advertiser.php', '_blank');
				if(win){
				    //Browser has allowed it to be opened
				    win.focus();
				}else{
				    //Broswer has blocked it
				    alert('Please allow popups for this site');
				}
			}else{
		    alert(data);}
	}
})
	
	
}})



})();
