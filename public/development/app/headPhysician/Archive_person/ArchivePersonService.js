angular
    .module('headPhysicianApp')
    .service('archivePersonService', function($http, $q) {

        function getPersonInfo(id) {
            var defer=$q.defer();

            $http.get('api/department_chief/inpatient/'+id+'/allInfo')
                .success(function(patients) {
                    defer.resolve(patients);

                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        return {
            getPersonInfo: getPersonInfo
        };

    });
