angular
 .module('headPhysicianApp')
    .service('InpatientInfoService', function($http, $q) {

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

        return {
            getInpatients: getInpatients,
            getGeneralInfo: getGeneralInfo
        };

    });