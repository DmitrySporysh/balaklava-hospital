angular
 .module('headPhysicianApp')
    .service('InpatientsService', function($http, $q) {

        function getInpatients() {
            var defer=$q.defer();

            $http.get('doctor/inpatients')
                .success(function(inpatients) {
                    defer.resolve(inpatients);

                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        return {
            getInpatients: getInpatients
        };

    });