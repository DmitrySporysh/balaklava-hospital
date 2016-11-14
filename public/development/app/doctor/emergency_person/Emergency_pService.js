angular
 .module('doctorApp')
    .service('DoctorEmergencyPersonService', function($http, $q) {



        function getInfoFromEmergency(id) {
            var defer=$q.defer();

            $http.get('doctor/received_patient/'+id)
                .success(function(patients) {
                    defer.resolve(patients);
                })
                .error(function(err) {
                    defer.reject(err);
                });

            console.log(defer.promise);
            /*return defer.promise;*/
        }



        /*function temp() {
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
        }*/

        return {
            getInfoFromEmergency: getInfoFromEmergency
        };

    });


/*
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
});*/
