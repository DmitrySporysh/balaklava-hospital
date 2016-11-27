angular
 .module('nurseApp')
    .service('ReceivedPatientsService', function($http, $q) {

        function getRecievedPatients() {
            var defer=$q.defer();

            $http.get('medical_nurse/emergency/received_patients')
                .success(function(inpatients) {
                    defer.resolve(inpatients);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        return {
            getRecievedPatients: getRecievedPatients
        };

    });



