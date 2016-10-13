var emergencyRoomAppControllers = angular.module('emergencyRoomAppControllers', []);

emergencyRoomAppControllers.controller('LoginController', ['$scope', '$http', function ($scope, $http) {

}]);

emergencyRoomAppControllers.controller('NewPatientController', ['$scope', '$http', function ($scope, $http) {
    
}]);

emergencyRoomAppControllers.controller('MainController', ['$scope', '$http', function ($scope, $http) {

    $http.get('/patientsFio').success(function(patientsFio) {

        $scope.patientsFio = patientsFio;
    });

    $scope.submit=function(){
        alert(angular.toJson($scope.NewPatient));
    }
    
}]);