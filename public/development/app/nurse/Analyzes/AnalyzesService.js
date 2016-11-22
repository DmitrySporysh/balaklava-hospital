angular
    .module('nurseApp')
    .service('AnalyzesService', function($http, $q) {

        function getAllNotReadyAnalyzes() {
            var defer=$q.defer();

            $http.get('medical_nurse/getAllNotReadyAnalyzes')
                .success(function(inpatients) {
                    defer.resolve(inpatients);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            console.log(defer.promise);
            return defer.promise;
        }

        return {
            getAllNotReadyAnalyzes: getAllNotReadyAnalyzes
        };

    });



