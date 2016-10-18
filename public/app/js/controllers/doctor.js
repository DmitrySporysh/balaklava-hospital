var doctorAppControllers = angular.module('doctorAppControllers', [])
    .directive('tab_general', function () {
        return {
            templateUrl: "app/templates/doctor/patient_full/general.html"
        }
    })
    .directive('tab_results', function () {
        return {
            templateUrl: "app/templates/doctor/patient_full/results.html"
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
        template=('" '+template);
        console.log(template);
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


