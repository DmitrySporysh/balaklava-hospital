angular
    .module('nurseApp')
    .service('NewPatientService', function($http, $q) {

        function postGeneralEmergInfo(patientInfo) {
            var defer=$q.defer();

            $http.post('api/medical_nurse/emergency/addNewInpatient',patientInfo)
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });

            return defer.promise;
        }

        return {
            postGeneralEmergInfo: postGeneralEmergInfo
        };

    });

