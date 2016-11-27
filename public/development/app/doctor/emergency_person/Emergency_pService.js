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
            return defer.promise;
        }

        function getDepartments(id) {
                    var defer=$q.defer();

                    $http.get('doctor/departments')
                        .success(function(patients) {
                            defer.resolve(patients);
                        })
                        .error(function(err) {
                            defer.reject(err);
                        });
                    return defer.promise;
                }

        function postInfoFromEmergency(patientInfo, id) {
            patientInfo.id = id;
            var defer=$q.defer();

            $http.post('/doctor/addNewInspectionProtocol',patientInfo)
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        return {
            getDepartments: getDepartments,
            getInfoFromEmergency: getInfoFromEmergency,
            postInfoFromEmergency: postInfoFromEmergency
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
