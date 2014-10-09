
gemastikApp.service('FBService', function($window,$http,$q) {
	var appId = "701116673300033";
	var accessToken;
	var apiUrl = "graph.facebook.com/v2.1";
	var FB = $window.FB;
	
	//get profpict of user
	this.getProfilePicture = function(userId){
		var result = $q.defer();

		FB.api("/"+userId+"/picture?redirect=false&access_token="+accessToken,{},function(response){
			console.log(response.data);
			result.resolve(response.data.url);
		});

		return result.promise;
	}

	this.getUser = function(userId){
		var result = $q.defer();
		FB.api("/"+userId+"?access_token="+accessToken,{},function(response){
			result.resolve(response);
		});

		return result.promise;
	}

	//set user access token
	
	this.setAccessToken = function(token){
		accessToken = token;
	}
});

