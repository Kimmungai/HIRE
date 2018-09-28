// angular validation

var app = angular.module('validate', []);

//main registration controller
app.controller('ValidateCtrl', function ($scope, $http) {
	$scope.formModel = {};

	$scope.onSubmit = function(valid){
    if(valid){
        console.log("Hey i'm submitted!");
		console.log($scope.formModel);
        //$http.post('https://minmax-server.herokuapp.com/register/', $scope.formModel).
		//	success(function (data) {
		//		console.log(":)")
		//	}).error(function(data) {
		//		console.log(":(")
		//	});

    } else {
        console.log("Form is invalid");
    }
		
	};
});


//password set controller
app.controller('ConfirmCtrl', function ($scope, $http) {
	$scope.formModel = {};

	$scope.onSubmit = function(valid){
    if(valid){
        console.log("Hey i'm submitted!");
        
		//$http.post('https://minmax-server.herokuapp.com/register/', $scope.formModel).
		//	success(function (data) {
		//		console.log(":)")
		//	}).error(function(data) {
		//		console.log(":(")
		//	});
    } else {
        console.log("Form is invalid");
    }
		
	};
});

// mypage update controller
app.controller('UpdateCtrl', function ($scope, $http) {
	$scope.formModel = {};

	$scope.onSubmit = function(valid){
    if(valid){
        console.log("Hey i'm submitted!");
        
		//$http.post('https://minmax-server.herokuapp.com/register/', $scope.formModel).
		//	success(function (data) {
		//		console.log(":)")
		//	}).error(function(data) {
		//		console.log(":(")
		//	});
    } else {
        console.log("Form is invalid");
    }
		
	};
});