

angular.module('chatApp').controller('DrugsController', ['$scope', '$http', '$log', '$window', '$interval', function ($scope, $http, $log, $window, $interval) {
	
	$scope.commentList = [];
	
	$scope.commentId = 1;
	
	var getUpdates = function(){ 
		$http.get('http://localhost:8888/api/drugs/5/' + $scope.commentId)
			.success(function (data, status) {
				if (status == 200) {
					$scope.commentList = $scope.commentList.concat(data);
					
					$scope.commentId = data[data.length - 2].id;
					
					//alert($scope.commentId);
				}
				else {
					alert("Greska so povrzuvanje so localhost:8080")
				}
			})
			.error(function (data, status) {
				alert("Greska")
			});
	}
	
	$interval(getUpdates, 3000);
	
	getUpdates();
	
}]);

