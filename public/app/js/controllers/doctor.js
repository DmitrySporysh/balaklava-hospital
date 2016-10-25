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
    $http.get('doctor/emergency?page=1').success(function(patients) {
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
        console.log(patients[0]);
    });

    $scope.save_analiz = function (patient, PatientProtocol){
        $scope.response={};
        if(PatientProtocol.$valid){
            if (patient==undefined)
                patient={};
            patient.inpatient_id=$scope.testFactory.patient_full_id;
            $http.post("doctor/inpatient/addAnalysis", patient).success(function (answ) {
                $scope.response=answ;
                $scope.analizes.unshift(answ);
            });
        }
    };


    $scope.save_cond = function (patient, PatientProtocol){
        $scope.response={};
        if(PatientProtocol.$valid){
            if (patient==undefined)
                patient={};
            patient.inpatient_id=$scope.testFactory.patient_full_id;
            $http.post("doctor/inpatient/addInspection", patient).success(function (answ) {
                $scope.response=answ;
                $scope.inspections.unshift(answ);
            });
        }
    };

    $scope.save_oper = function (patient, PatientProtocol){
        $scope.response={};
        if(PatientProtocol.$valid){
            if (patient==undefined)
                patient={};
            patient.inpatient_id=$scope.testFactory.patient_full_id;
            $http.post("doctor/inpatient/addOperation", patient).success(function (answ) {
                $scope.response=answ;
                $scope.operations.unshift(answ);
            });
        }
    };

    $scope.save_appoint = function (patient, PatientProtocol){
        $scope.response={};
        if(PatientProtocol.$valid){
            if (patient==undefined)
                patient={};
            patient.inpatient_id=$scope.testFactory.patient_full_id;
            $http.post("doctor/inpatient/addMedicalAppointment", patient).success(function (answ) {
                $scope.response=answ;
                $scope.prescriptions.unshift(answ);
            });
        }
    };

    $scope.save_procedure = function (patient, PatientProtocol){
        $scope.response={};
        if(PatientProtocol.$valid){
            if (patient==undefined)
                patient={};
            patient.inpatient_id=$scope.testFactory.patient_full_id;
            $http.post("doctor/inpatient/addProcedure", patient).success(function (answ) {
                $scope.response=answ;
                $scope.dressings.unshift(answ);
            });
        }
    };


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
                    $http.get('doctor/inpatient/'+$scope.testFactory.patient_full_id+'/procedures').success(function(dressings) {
                        $scope.dressings = dressings;
                    });
                    $http.get('doctor/inpatient/'+$scope.testFactory.patient_full_id+'/operations').success(function(operations) {
                        $scope.operations = operations;
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




doctorAppControllers.controller('ArchiveController', function ($scope, $http, testFactory) {
    $http.get('doctor/archive').success(function(patients) {
        $scope.patients_info = patients.data;
    });

    $scope.testFactory=testFactory;
    $scope.follow_id = function (inpatient_number){
        $scope.testFactory.inpatient_number = inpatient_number;
    };

    $scope.change = function() {
        console.log($scope.filter);
        $http({method:'GET', url:'/doctor/archive', params: $scope.filter})
            .success(function (answ) {
                $scope.response=answ;
                console.log(answ);
            });
    };

});


doctorAppControllers.controller('ArchivePatientController', function ($scope, $http, testFactory) {

    /*$scope.testFactory=testFactory;
    console.log($scope.testFactory.inpatient_number);*/

    /*$http.get('/doctor/getInpatientAllInfo/8').success(function(patients) {
        $scope.patient_info = patients[0];

        /!*console.log($scope.patient_info);*!/
    });*/

    $http.get('doctor/getInpatientAllInfo/8').success(function(patients) {
        $scope.patients_info = patients.data;
        console.log($scope.patients_info);
    });


});


/*------------FACTORIES------------*/
doctorAppControllers.factory('testFactory', function() {
    return {
        patient_full_id: 'null',
        new_action: function (post, form, url, model){
            $scope.response={};
            if(form.$valid){
                if (post==undefined)
                    post={};
                post.inpatient_id=$scope.testFactory.patient_full_id;
                $http.post("doctor/inpatient/"+url, model).success(function (answ) {
                    $scope.response=answ;
                    $scope.model.unshift(answ);
                });
            }
        }
    }
});
