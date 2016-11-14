angular
 .module('doctorApp')
    .service('InpatientTreatmentService', function($http, $q) {

        function getGeneralInfo(id) {
            var defer=$q.defer();

            $http.get('doctor/inpatient/'+id)
                .success(function(generalInfo) {
                    defer.resolve(generalInfo);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            
            return defer.promise;
        }

        function getAnalyzes(id) {
            var defer=$q.defer();

            $http.get('doctor/inpatient/'+id+'/analyzes')
                .success(function(analyzes) {
                    defer.resolve(analyzes);
                })
                .error(function(err) {
                    defer.reject(err);
                });

            return defer.promise;
        }

        function getInspections(id) {
            var defer=$q.defer();

            $http.get('doctor/inpatient/'+id+'/inspections')
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function getProcedures(id) {
            var defer=$q.defer();

            $http.get('doctor/inpatient/'+id+'/procedures')
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function getOperations(id) {
            var defer=$q.defer();

            $http.get('doctor/inpatient/'+id+'/operations')
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function getPrescriptions(id) {
            var defer=$q.defer();

            $http.get('doctor/inpatient/'+id+'/medical_appointments')
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function getInspectionProtocol(id) {
            var defer=$q.defer();

            $http.get('doctor/inpatient/'+id+'/inspection_protocol')
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }
        




        return {
            getGeneralInfo: getGeneralInfo,
            getAnalyzes: getAnalyzes,
            getInspections: getInspections,
            getProcedures: getProcedures,
            getOperations: getOperations,
            getPrescriptions: getPrescriptions,
            getInspectionProtocol: getInspectionProtocol
        };

    });


/*
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
});*/
