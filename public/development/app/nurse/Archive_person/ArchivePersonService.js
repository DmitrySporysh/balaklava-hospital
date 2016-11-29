angular
    .module('nurseApp')
    .service('archivePersonService', function($http, $q) {

        function getPersonInfo(id) {
            var defer=$q.defer();


            console.log('api/medical_nurse/inpatient/'+id+'/allInfo');
            $http.get('api/medical_nurse/inpatient/'+id+'/allInfo')
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
