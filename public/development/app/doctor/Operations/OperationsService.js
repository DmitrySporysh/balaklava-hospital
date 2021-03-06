angular
    .module('doctorApp')
    .service('OperationsService', function($http, $q) {

        function getAllNotReadyOperations() {
            var defer=$q.defer();

            $http.get('api/doctor/operation/getAllNotReadyOperations')
                .success(function(inpatients) {
                    defer.resolve(inpatients);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function addOperationResult(date, id) {
            var defer=$q.defer();
            date.operation_id  = id;

            $http.post('api/doctor/operation/addOperationResult',date)
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });

            return defer.promise;
        }


        return {
            getAllNotReadyOperations: getAllNotReadyOperations,
            addOperationResult: addOperationResult
        };

    });



