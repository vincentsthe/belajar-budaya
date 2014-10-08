gemastikApp.service('FacebookService', function($http) {
	var appId = "701116673300033";
	var apiUrl = "graph.facebook.com/v2.1";
	//get profpict of user
	this.getProfilePicture = function(userId){
		$http.get("/"+userId+"/picture").
		success(function(data,status,headers,config){
			return data.data.url;
		});
	}
});