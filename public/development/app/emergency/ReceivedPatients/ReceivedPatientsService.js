angular
 .module('emergencyApp')
    .service('ReceivedPatientsService', function($http, $q) {

        function getRecievedPatients() {
            var defer=$q.defer();

            $http.get('/emergency/patients')
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



