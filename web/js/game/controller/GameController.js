var getDivHeight = function() {
	var windowHeight = parseInt($(window).height());
	var headerHeight = parseInt($("#header").outerHeight());
	var footerHeight = parseInt($("#footer").outerHeight());
	var paddingTop = parseInt($("#chatDiv").css('padding-top'));
	var paddingBottom = parseInt($("#chatDiv").css('padding-bottom'));

	var height = windowHeight - headerHeight - footerHeight - paddingTop - paddingBottom;
	return height + "px";
};

var createAnswer = function(answer) {
	var tr = document.createElement("tr");
	var td = document.createElement("td");

	if(answer.result) {
		td.setAttribute("class", "green");
	} else {
		td.setAttribute("class", "red");
	}
	tr.appendChild(td);
	td.appendChild(document.createTextNode(answer.user + ": " + answer.answer));
	document.getElementById("table").getElementsByTagName("tbody")[0].appendChild(tr);

	var elem = document.getElementById('chatDiv');
  	elem.scrollTop = elem.scrollHeight;
};

gemastikApp.controller('GameController', ['$scope', '$interval', 'GameService',
								function($scope, $interval, GameService) {
	var roomNumber = 3;
	var timeRemaining;

	GameService.getTimeRemaining(roomNumber).then(function(time) {
		timeRemaining = time;
		$scope.timeLeft = timeRemaining;

		var interval = $interval(function() {
			changeQuestion();
		}, (timeRemaining*1000)+100);
	});

	$scope.score = 0;
	
	$("#chatDiv").height(getDivHeight());
	
	$scope.submitAnswer = function() {
		GameService.sendAnswer(roomNumber, $scope.answer.toLowerCase()).then(function(data) {
			$scope.answer = "";
		});
	};

	$interval(function() {
		GameService.getAnswer(roomNumber).then(function(answers) {
			answers.foreach(function(answer) {
				createAnswer(answer);
			});
		});
	}, 300);

	changeQuestion = function() {
		$interval.cancel(interval);

		GameService.getTimeRemaining(roomNumber).then(function(timeRemaining) {
			$scope.timeLeft = timeRemaining;

			var interval = $interval(function() {
				changeQuestion();
			}, (timeRemaining*1000)+100);

			GameService.getProblem(roomNumber).then(function(question) {
				$scope.questions = [];

				for(var category in question['pertanyaan']) {
					$scope.questions.push({
						'category': category,
						'answer': question['pertanyaan'][category],
						'answered': false,
					});
				}

				$scope.nama = question.nama;
			});
		});
	}


}]);