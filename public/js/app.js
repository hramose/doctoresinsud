var app = angular.module('CamposBaseApp', ['ngRoute'], function($interpolateProvider) {
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');
});
 
app.controller('CamposBaseController', function($scope, $http) {
 	
	$scope.camposbase = [];
	$scope.loading = false;
 
	$scope.init = function() {
		$scope.loading = true;
	/*	$http.get('/camposbase').success(function(data, status, headers, config) {
			$scope.campobase = data;
				$scope.loading = false;
 
		});*/
	}
 	

 	$scope.models = {
        selected: null,
        lists: {"A": [], "B": []}
    };



    // Generate initial model
    for (var i = 1; i <= 3; ++i) {
        $scope.models.lists.A.push({label: "Item A" + i});
        $scope.models.lists.B.push({label: "Item B" + i});
    }

    // Model to JSON for demo purpose
    $scope.$watch('models', function(model) {
        $scope.modelAsJson = angular.toJson(model, true);
    }, true);


 	

	$scope.addCampoBase = function() {
		
		


		$scope.loading = true;
        
		$http.post('/admin/estudios/camposbase1', 
		{
			nombre: $scope.camposbase.nombre,
			descripcion: $scope.camposbase.descripcion,
			tipo: $scope.camposbase.tipo,
			id_unidad: $scope.camposbase.id_unidad,
			ref_min: $scope.camposbase.ref_min,
			ref_max: $scope.camposbase.ref_max

			}).success(function(data, status, headers, config) {


			$scope.camposbase.push(data);

			
			$('.selectCampos').each(function(index){
			 				// $( this ).empty();
 				var newOption = $('<option value="'+$scope.camposbase.id+'" >'+$scope.camposbase.nombre+'</option>');
        		$(this).append(newOption);
        		$(this).trigger("chosen:updated");
    		

				$( this ).select($scope.camposbase.id);
 			});



			$scope.campobase = '';
			$scope.loading = false;
 			$scope.camposbase.nombre = '';
 			$scope.camposbase.descripcion = '';
 			$scope.camposbase.tipo = '';
 			$scope.camposbase.id_unidad='';
 			$scope.camposbase.ref_min='';
 			$scope.camposbase.ref_max='';
 			$('#myModal').modal('hide');

 			
				

		});
	};

		$http.post('/admin/estudios/camposbase/getAllCamposBase/').success(function(data, status, headers, config){
		        			
		        				$scope.campos = data;
		        				//alert(data);

		        				
		});

 
	$scope.init();
 
});