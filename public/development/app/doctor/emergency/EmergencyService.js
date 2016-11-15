angular
 .module('doctorApp')
    .service('DoctorEmergencyService', function($http, $q) {

        function getEmergencyPeople() {
            var defer=$q.defer();

            $http.get('doctor/emergency?page=1')
                .success(function(patients) {
                    defer.resolve(patients);

                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        return {
            getEmergencyPeople: getEmergencyPeople
        };

    });