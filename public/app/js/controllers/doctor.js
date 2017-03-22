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
                });
                break;
            case 'tab-results' :
                $http.get('doctor/inpatient/'+$scope.testFactory.patient_full_id+'/analyzes').success(function(analizes) {
                    $scope.analizes = analizes;
                });
                break;
            case 'tab-dynamic' :
                {
                    $http.get('doctor/inpatient/'+$scope.testFactory.patient_full_id+'/inspections').success(function(inspections) {
                        $scope.inspections = inspections;
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
                });
                break;
            case 'tab-first-inspection' :
                $http.get('doctor/inpatient/'+$scope.testFactory.patient_full_id+'/inspection_protocol').success(function(patients) {
                    $scope.patient_info = patients[0];
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
        $http({method:'GET', url:'/doctor/archive', params: $scope.filter})
            .success(function (answ) {
                $scope.response=answ;
            });
    };

});


doctorAppControllers.controller('ArchivePatientController', function ($scope, $http, testFactory) {

    $scope.testFactory=testFactory;

    var date_comp={
        'analyzes':'appointment_date',
        'inpatient_info':'start_date',
        'inspection_protocol':'date',
        'inspections':'inspection_date',
        'medical_appointments':'date',
        'operations':'appointment_date',
        'procedures':'procedure_date'
        };
    var name_comp={
        'analyzes':'analysis_name',
        'inpatient_info':'fio',
        'inspection_protocol':'complaints',
        'inspections':'description_extended',
        'medical_appointments':'description',
        'operations':'operation_name',
        'procedures':'procedure_name'
    };

    var type_comp={
        'analyzes':'Анализ',
        'inpatient_info':'Информ???',
        'inspection_protocol':'Протокол',
        'inspections':'Осмотр',
        'medical_appointments':'Назначение',
        'operations':'Операция',
        'procedures':'Процедура'
    };

    $scope.name_comp=name_comp;
    $scope.type_comp=type_comp;
    $scope.date_comp=date_comp;

    $http.get('doctor/getInpatientAllInfo/'+$scope.testFactory.inpatient_number).success(function(ans) {
        $scope.full_info = ans;

        var sort_date=[];
        var date_to_in;

        for (block in ans) {
            for (row in ans[block]) {
                var date = ans[block][row][date_comp[block]];

                sort_date.push({
                    'block':block,
                    'row':row,
                    'date':date});
            }
        }


        for (item in sort_date)
        {
            date_to_in=sort_date[item]['date'];
            date_to_in=date_to_in.replace(/-/g, "").replace(/:/g, "").replace(" ", "");
            date_to_in=parseInt(date_to_in);

            sort_date[item]['date']=date_to_in;
        }

        sort_date = sort_date.sort(function (b, a) {
            return (b.date - a.date)
        });

        $scope.date_sort=sort_date;
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
