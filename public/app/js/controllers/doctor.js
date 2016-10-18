var doctorAppControllers = angular.module('doctorAppControllers', []);

doctorAppControllers.controller('DashController', ['$scope', '$http', function ($scope, $http) {

}]);

doctorAppControllers.controller('ReportsController', ['$scope', '$http', function ($scope, $http) {

}]);

doctorAppControllers.controller('EmergencyController', ['$scope', '$http', function ($scope, $http) {

}]);

doctorAppControllers.controller('EmergencyPersonController', ['$scope', '$http', function ($scope, $http) {

}]);

doctorAppControllers.controller('PatientsController', ['$scope', '$http', function ($scope, $http) {

    /*$http.get('/patientsFio').success(function(patientsFio) {
        $scope.patientsFio = patientsFio;
    });

    $scope.save = function (patient, NewPatient){
        $scope.response={};
        if(NewPatient.$valid){
            $http.post("/patient/addNew", patient).success(function (answ) {
                $scope.response=answ;
            });
        }
    };*/

}]);


