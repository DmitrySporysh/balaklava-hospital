var doctorAppControllers = angular.module('doctorAppControllers', []);

doctorAppControllers.directive('patientInfo', function () {
    return {
        templateUrl: "app/templates/doctor/patient_full/general.html"
    }
});

doctorAppControllers.controller('PatientFullController', ['$scope', '$http', function ($scope, $http) {

}]);

doctorAppControllers.controller('EmergencyPersonController', ['$scope', '$http', function ($scope, $http) {

}]);

doctorAppControllers.controller('PatientsController', ['$scope', '$http', function ($scope, $http) {
    $http.get('doctor/inpatients').success(function(patients) {
        $scope.patients_info = patients.data;
    });
}]);


