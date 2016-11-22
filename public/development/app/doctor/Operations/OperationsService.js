angular
    .module('doctorApp')
    .service('OperationsService', function($http, $q) {

        function getAllNotReadyOperations() {
            var defer=$q.defer();

            $http.get('doctor/getAllNotReadyOperations')
                .success(function(inpatients) {
                    defer.resolve(inpatients);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            console.log(defer.promise);
            /*return defer.promise;*/
        }

        function postOperationsResult(analysesInfo) {
            var defer=$q.defer();

            $http.post('medial_nurse/addNewInpatient',analysesInfo)
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });

            console.log(defer.promise);
            /*return defer.promise;*/
        }


        return {
            getAllNotReadyOperations: getAllNotReadyOperations,
            postOperationsResult: postOperationsResult
        };

    });



