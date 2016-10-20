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

doctorAppControllers.controller('EmergencyPersonController', function ($scope, $http, testFactory) {

    $scope.testFactory=testFactory;

    $http.get('doctor/received_patient/'+$scope.testFactory.patient_full_id).success(function(patients) {
        $scope.patient_info = patients[0];

        var temp= angular.element($("#EmergencyController")).scope();
        console.log($scope.testFactory);
    });
});

doctorAppControllers.controller('EmergencyController', function ($scope, $http, testFactory) {
    $http.get('doctor/emergency').success(function(patients) {
        $scope.patients_info = patients.data;
    });

    $scope.testFactory=testFactory;

    $scope.follow_id = function (id){
        $scope.testFactory.patient_full_id = id;
        console.log($scope.testFactory.patient_full_id);
        console.log($scope.testFactory.patient_full_id);
    };

});

doctorAppControllers.controller('PatientsController', ['$scope', '$http', function ($scope, $http) {
    $http.get('doctor/inpatients').success(function(patients) {
        $scope.patients_info = patients.data;
    });
}]);


doctorAppControllers.factory('testFactory', function() {
    return {
        patient_full_id: 'null'
    }
});
