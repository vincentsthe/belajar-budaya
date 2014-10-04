gemastikApp.factory('AIFactory', function() {
	var counter = 0;

	var factory = {
		getString: function() {
			var str;

			if(counter == 0) {
				str = "1831";
			} else if(counter == 1) {
				str = "1832";
			} else if(counter == 2) {
				str = "Roro Jonggrang";
			} else if(counter == 3) {
				str = "Yogyakarta";
			} else if(counter == 4) {
				str = "Jawa Tengah";
			} else if(counter == 5) {
				str = "Belanda";
			}

			counter++;
			if(counter == 6) {
				counter = 0;
			}

			return str;
		}
	};

	return factory;
});