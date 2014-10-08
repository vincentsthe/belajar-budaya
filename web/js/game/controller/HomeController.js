gemastikApp.controller('HomeController', ['FacebookService', function($scope){
	$scope.getProfilePicture = function(userId){ return FacebookService.getProfilePicture(userId); }
	$scope.getUserData = function(userId){ return FacebookService.getUserData(userId); }
}]);