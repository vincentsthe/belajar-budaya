gemastikApp.controller('HomeController', ['$rootScope','$scope','$q','FBService','ApiService', function($rootScope,$scope,$q,FBService,ApiService){
	$scope.topUsers = [];

	$scope.init = function(){
		$rootScope.accessTokenActive.then(function(){
			ApiService.getTopFive()
			.then(function(data){
				for(var i in data){
					$scope.topUsers.push({"score":data[i].score});

					FBService.getUser(data[i].fb_id)
					.then(function(val){
						$scope.topUsers[i].name = val.name;
					});
					FBService.getProfilePicture(data[i].fb_id)
					.then(function(val){
						$scope.topUsers[i].picture_url = val;
					})
				}
			});
		});
	}

	$scope.getProfilePicture = function(userId){ return FacebookService.getProfilePicture(activeUser.fb_id); }
	$scope.getUserData = function(userId){ return FacebookService.getUserData(activeUser.fb_id); }
}]);