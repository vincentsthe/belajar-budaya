gemastikApp.factory('UrlFactory', function() {
	var baseUrl = "http://localhost/gemastik7-backend/web/index.php";

	var factory = {
		/**
		 * Send a GET request to server to retrieve current problem information.
		 * 
		 * expected JSON response format:
		 * {
		 *		nama: string 			// name of the question item
		 *		timeRemaining: integer	// time remaining to answer the question for the item
		 *		pertanyaan: JSON Object // key-value item of question: answer
		 *		{
		 *			question: answer 	// item question and answer of the question, will have multiple of this key-value for pertanyaan object
		 *		}
		 * }
		 */
		getProblem: function(roomNumber) {
			return baseUrl + "/api/problem/get/" + roomNumber;
		},

		/**
		 * Send a POST request to the server to send the user answer.
		 * 
		 * JSON format to be send to the server:
		 * {
		 *		answer: string		// User's answer
		 * }
		 */
		sendAnswer: function(roomNumber) {
			return baseUrl + "/api/problem/answer/" + roomNumber;	//send user answer
		},

		/**
		 * Send a POST request to the server to get the answer for the room given.
		 * 
		 * JSON format to be send to the server:
		 * {
		 *		lastId: integer		// Last id received by the frontend, 0 if frontend have not received any answer
		 * }
		 * 
		 * Expected JSON response format:
		 * {
		 *		lastAnswer: integer			// lastId of the answer sent to the frontend, 0 if no answer if sent
		 *		answer: JSON object 		// JSON object consist of (multiple) answer
		 *		{
		 *			{						// one of the answer objecy
		 *				user: string		// the username of the user
		 *				answer: string		// user's answer
		 *				result: boolean		// true if the answer is correct for the problem
		 *			}
		 *		}
		 * }
		 */
		getAnswer: function(roomNumber) {
			return baseUrl + "/api/problem/getAnswer/" + roomNumber;	//get user answer
		}
		
	};

	return factory;
});