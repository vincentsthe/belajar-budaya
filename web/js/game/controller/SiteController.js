gemastikApp.controller('SiteController', ['$rootScope','$scope','$q','FBService','ApiService', function($rootScope,$scope,$q,FBService,ApiService){
	$scope.activeUser;
	$scope.profilePicture;

	$rootScope.accessTokenActive;

	$scope.init = function(){
		var cok = $q.defer();

		ApiService.getCurrentUser()
		.then(function(val){
			FBService.setAccessToken(val.fb_access_token);
			FBService.getUser(val.fb_id)
			.then(function(result){
				$scope.activeUser = result;
				cok.resolve();
			});
		});
		
		$rootScope.accessTokenActive = cok.promise;
	}

	$scope.getProfilePicture = function(userId){ return FacebookService.getProfilePicture(activeUser.fb_id); }
	$scope.getUserData = function(userId){ return FacebookService.getUserData(activeUser.fb_id); }
}]);