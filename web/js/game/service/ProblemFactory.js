gemastikApp.factory('ProblemFactory', function() {
	var counter = 0;

	var factory = {
		getProblem: function() {
			var problem;

			if(counter == 0) {
				problem = {
					'nama': 'Prambanan',
					'pertanyaan': {
						'Lokasi': 'Yogyakarta',
						'Pendiri': 'Roro Jonggrang',
						'Tahun Berdiri': '1832'
					}
				};
			} else if(counter == 1) {
				problem = {
					'nama': 'Borobudur',
					'pertanyaan': {
						'Lokasi': 'Jawa Tengah',
						'Pendiri': 'Syailendra'
					}
				};
			} else {
				problem = {
					'nama': 'Gedung Sate',
					'pertanyaan': {
						'Kota': 'Bandung',
						'Asal Arsitek': 'Belanda'
					}
				};
			}

			counter++;
			if(counter == 3) {
				counter = 0;
			}

			return problem;
		}
	};

	return factory;
});