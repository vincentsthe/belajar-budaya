gemastikApp.config(['$routeProvider', function($routeProvider) {
	
	$routeProvider.when('/login', {
		templateUrl: 'partials/login.html',
		controller: 'LoginController',
	});

	$routeProvider.when('/menu', {
		templateUrl: 'partials/menu.html',
		controller: 'MenuController',
	});
	
	$routeProvider.when('/play', {
		templateUrl: 'partials/game.html',
		controller: 'GameController',
	});

	$routeProvider.when('/wiki', {
		templateUrl: 'partials/wiki.html',
		controller: 'WikiController',
	});
	
	$routeProvider.when('/additem', {
		templateUrl: 'partials/additem.html',
	});
	
	$routeProvider.otherwise({
		redirectTo: '/login',
	});
}]);
