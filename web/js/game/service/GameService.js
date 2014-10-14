gemastikApp.factory('GameService', ['$http', '$q', 'UrlFactory', function($http, $q, UrlFactory) {
	var counter = 0;
	var lastId = 0;

	var factory = {
		getProblem: function(roomNumber) {
			var result = $q.defer();
			var problem = {};

			$http.get(UrlFactory.getProblem(roomNumber))
				.success(function(data) {
					problem.nama = data.nama;
					problem.pertanyaan = {};
					for(var key in data.pertanyaan) {
						problem.pertanyaan[key] = data.pertanyaan[key];
					}

					result.resolve(problem);
				});

			return result.promise;
		},
		getTimeRemaining: function(roomNumber) {
			var result = $q.defer();
			var timeRemaining;

			$http.get(UrlFactory.getProblem(roomNumber))
				.success(function(data) {
					timeRemaining = data.timeRemaining;
					result.resolve(timeRemaining);
				});

			return result.promise;
		},
		getAnswer: function(roomNumber) {
			var result = $q.defer();
			var answer = [];

			$http.post(UrlFactory.getAnswer(roomNumber), {'lastId': lastId})
				.success(function(data) {
					if(data.lastAnswer != 0) {
						lastId = data.lastAnswer;
					}
					result.resolve(data.answer);
				});

			return result.promise;
		},
		sendAnswer: function(roomNumber, answer) {
			$http.post(UrlFactory.sendAnswer(roomNumber), {'answer': answer});
		},
	};

	return factory;
}]);