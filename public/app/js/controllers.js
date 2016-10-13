var emergencyRoomAppControllers = angular.module('emergencyRoomAppControllers', []);

emergencyRoomAppControllers.controller('LoginController', ['$scope', '$http', function ($scope, $http) {

}]);

emergencyRoomAppControllers.controller('NewPatientController', ['$scope', '$http', function ($scope, $http) {
    
}]);

emergencyRoomAppControllers.controller('MainController', ['$scope', '$http', function ($scope, $http) {

    $http.get('/patientsFio').success(function(patientsFio) {

        $scope.patientsFio = patientsFio;
    });

    $scope.save = function (patient, NewPatient){

        $scope.response={};
        if(NewPatient.$valid){
            $http.post("/patient/addNew", patient).success(function (answ) {
                $scope.response=answ;
            });
        }
    };
    
}]);