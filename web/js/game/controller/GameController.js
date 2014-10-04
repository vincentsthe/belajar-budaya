gemastikApp.controller('GameController', ['$scope', '$interval', 'ProblemFactory', 'AIFactory', 
								function($scope, $interval, ProblemFactory, AIFactory) {

	$scope.tes = 1;
	$scope.score = 0;

	var getDivHeight = function() {
		var windowHeight = parseInt($(window).height());
		var headerHeight = parseInt($("#header").outerHeight());
		var footerHeight = parseInt($("#footer").outerHeight());
		var paddingTop = parseInt($("#chatDiv").css('padding-top'));
		var paddingBottom = parseInt($("#chatDiv").css('padding-bottom'));

		var height = windowHeight - headerHeight - footerHeight - paddingTop - paddingBottom;
		return height + "px";
	};
	$("#chatDiv").height(getDivHeight());
	
	$scope.submitAnswer = function() {
		var ada = false;
		for(var i=0 ; i<$scope.questions.length ; i++) {
			if(($scope.questions[i].answer.toLowerCase() === $scope.answer.toLowerCase()) && ($scope.questions[i].answered === false)) {
				$scope.questions[i].answered = true;
				ada = true;
			}
		}

		var tr = document.createElement("tr");
		var td = document.createElement("td");
		if(ada) {
			td.setAttribute("class", "green");
			$scope.score++;
		} else {
			td.setAttribute("class", "red");
		}
		tr.appendChild(td);
		td.appendChild(document.createTextNode("Vincent: " + $scope.answer + ""));
		document.getElementById("table").getElementsByTagName("tbody")[0].appendChild(tr);

		$scope.answer = "";

		var elem = document.getElementById('chatDiv');
  		elem.scrollTop = elem.scrollHeight;
	};

	var submitAIAnswer = function(str) {
		var ada = false;
		for(var i=0 ; i<$scope.questions.length ; i++) {
			if(($scope.questions[i].answer.toLowerCase() === str.toLowerCase()) && ($scope.questions[i].answered === false)) {
				$scope.questions[i].answered = true;
				ada = true;
			}
		}

		var tr = document.createElement("tr");
		var td = document.createElement("td");
		if(ada) {
			td.setAttribute("class", "green");
		} else {
			td.setAttribute("class", "red");
		}
		tr.appendChild(td);
		td.appendChild(document.createTextNode("Yafi: " + str + ""));
		document.getElementById("table").getElementsByTagName("tbody")[0].appendChild(tr);

		var elem = document.getElementById('chatDiv');
  		elem.scrollTop = elem.scrollHeight;
	};

	$interval(function() {
		submitAIAnswer(AIFactory.getString());
	}, 2000);

	changeQuestion = function() {
		$scope.timeLeft = 7;
		var interval = $interval(function() {
			$scope.timeLeft = $scope.timeLeft-1;
			if($scope.timeLeft == 0) {
				$interval.cancel(interval);
				changeQuestion();
			}
		}, 1000);

		var question = ProblemFactory.getProblem();
		$scope.questions = [];

		for(var category in question['pertanyaan']) {
			$scope.questions.push({
				'category': category,
				'answer': question['pertanyaan'][category],
				'answered': false,
			});
		}

		$scope.nama = question.nama;
	}
	changeQuestion();


}]);