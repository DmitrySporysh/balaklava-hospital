var doctorAppControllers = angular.module('doctorAppControllers', [])
    .directive('tabGeneral', function () {
        return {
            templateUrl: "app/templates/doctor/patient_full/general.html"
        }
    })
    .directive('tabResults', function () {
        return {
            templateUrl: "app/templates/doctor/patient_full/results.html"
        }
    })
    .directive('tabDynamic', function () {
        return {
            templateUrl: "app/templates/doctor/patient_full/dynamic.html"
        }
    })
    .directive('tabPrescriptions', function () {
        return {
            templateUrl: "app/templates/doctor/patient_full/prescriptions.html"
        }
    })
    .directive('tabFirstInspection', function () {
        return {
            templateUrl: "app/templates/doctor/patient_full/first_inspection.html"
        }
    });

doctorAppControllers.controller('PatientFullController', ['$scope', '$http', function ($scope, $http) {
    $scope.area_change = function (template){
        $scope.response={};
        if(template=='results'){
                console.log('r');
            }
        if(template=='general'){
            console.log('g');
        }
        $scope.active_menu=template;
    };
}]);

doctorAppControllers.controller('EmergencyPersonController', ['$scope', '$http', function ($scope, $http) {

}]);

doctorAppControllers.controller('PatientsController', ['$scope', '$http', function ($scope, $http) {
    $http.get('doctor/inpatients').success(function(patients) {
        $scope.patients_info = patients.data;
    });
}]);


