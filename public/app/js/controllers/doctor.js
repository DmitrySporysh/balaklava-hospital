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


doctorAppControllers.controller('EmergencyController', function ($scope, $http, testFactory) {
    $http.get('doctor/emergency').success(function(patients) {
        $scope.patients_info = patients.data;
    });

    $scope.testFactory=testFactory;

    $scope.follow_id = function (id){
        $scope.testFactory.patient_full_id = id;
    };
});

doctorAppControllers.controller('EmergencyPersonController', function ($scope, $http, testFactory) {
    $scope.testFactory=testFactory;

    $http.get('doctor/received_patient/'+$scope.testFactory.patient_full_id).success(function(patients) {
        $scope.patient_info = patients[0];
    });

    $scope.save = function (patient, PatientProtocol){
        $scope.response={};
        if(PatientProtocol.$valid){
            if (patient==undefined)
                patient={};
            patient.id=$scope.testFactory.patient_full_id;
            $http.post("/doctor/addNewInspectionProtocol", patient).success(function (answ) {
                $scope.response=answ;

            });
        }
    };
});

doctorAppControllers.controller('PatientsController', function ($scope, $http, testFactory) {
    $http.get('doctor/inpatients').success(function(patients) {
        $scope.patients_info = patients.data;
    });


    $scope.testFactory=testFactory;
    $scope.follow_id = function (id){
        $scope.testFactory.patient_full_id = id;

    };
});


doctorAppControllers.controller('PatientFullController', function ($scope, $http, testFactory) {
    $scope.testFactory=testFactory;
    $http.get('doctor/inpatient/'+$scope.testFactory.patient_full_id).success(function(patients) {
        $scope.patient_info = patients[0];
    });

    $scope.area_change = function (template){
        $scope.active_menu=template;

        switch(template) {
            case 'tab-general' :
                $http.get('doctor/inpatient/'+$scope.testFactory.patient_full_id).success(function(patients) {
                    $scope.patient_info = patients[0];
                    console.log($scope.patient_info)
                });
                break;
            case 'tab-results' :
                $http.get('doctor/inpatient/'+$scope.testFactory.patient_full_id+'/analyzes').success(function(analizes) {
                    $scope.analizes = analizes;
                    console.log($scope.analizes);
                });
                break;
            case 'tab-dynamic' :
                {
                    $http.get('doctor/inpatient/'+$scope.testFactory.patient_full_id+'/inspections').success(function(inspections) {
                        $scope.inspections = inspections;
                        console.log($scope.inspections);
                    });
                    $http.get('doctor/inpatient/'+$scope.testFactory.patient_full_id+'/dressings').success(function(dressings) {
                        $scope.dressings = dressings;
                        console.log($scope.dressings);
                    });
                    $http.get('doctor/inpatient/'+$scope.testFactory.patient_full_id+'/operations').success(function(operations) {
                        $scope.operations = operations;
                        console.log($scope.operations);
                    });
                    break;
                }
            case 'tab-prescriptions' :
                $http.get('doctor/inpatient/'+$scope.testFactory.patient_full_id+'/medical_appointments').success(function(prescriptions) {
                    $scope.prescriptions = prescriptions;
                    console.log($scope.prescriptions);
                });
                break;
            case 'tab-first-inspection' :
                $http.get('doctor/inpatient/'+$scope.testFactory.patient_full_id+'/inspection_protocol').success(function(patients) {
                    $scope.patient_info = patients[0];
                    console.log($scope.patient_info);
                });
                break;
        }
    };
});


/*------------FACTORIES------------*/
doctorAppControllers.factory('testFactory', function() {
    return {
        patient_full_id: 'null'
    }
});
