
gemastikApp.factory('ApiService', function($http,$q) {
	var apiUrl = '/belajar-budaya/web/index.php/api';

	return {
		getCurrentUser: function(){
			var result = $q.defer();

			$http.get(apiUrl+"/user/current")
			.then(function(response){
				result.resolve(response.data);
			},function(error){
				result.reject(error);
			});

			return result.promise;
		},

		getUser: function(userId){
			$http.get(apiUrl+"/user/get?id="+userId).
			success(function(data,status,headers,config){
				return data;
			});
		},

		getTopFive : function(){
			var result = $q.defer();

			$http.get(apiUrl+"/user/topfive")
			.then(function(response){
				result.resolve(response.data);
			});

			return result.promise;
		}
	}
});