var app = angular.module('estudiosApp', [], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});
 
app.controller('EstudiosController', function($scope, $http) {
 
	$scope.camposbase = [];
	$scope.loading = false;
 
	$scope.init = function() {
		$scope.loading = true;
		$http.get('/api/estudios').
		success(function(data, status, headers, config) {
			$scope.camposbase = data;
				$scope.loading = false;
 
		});
	}
 
	$scope.agregaCampoBase = function() {
				$scope.loading = true;
 
		$http.post('/api/estudios', {
			nombre: $scope.campobase.nombre
		}).success(function(data, status, headers, config) {
			$scope.camposbase.push(data);
			$scope.campobase = '';
				$scope.loading = false;
 
		});
	};
 
	$scope.updateCampoBase = function(campobase) {
		$scope.loading = true;
 
		$http.put('/api/estudios/' + campobase.id, {
			nombre: campobase.title,
		}).success(function(data, status, headers, config) {
			campobase = data;
				$scope.loading = false;
 
		});;
	};
 
	$scope.borraCampoBase = function(index) {
		$scope.loading = true;
 
		var campobase = $scope.camposbase[index];
 
		$http.delete('/api/estudios/' + campobase.id)
			.success(function() {
				$scope.camposbase.splice(index, 1);
					$scope.loading = false;
 
			});;
	};
 
 
	$scope.init();
 
});
 