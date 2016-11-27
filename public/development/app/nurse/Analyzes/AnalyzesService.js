angular
    .module('nurseApp')
    .service('AnalyzesService', function($http, $q) {

        function getAllNotReadyAnalyzes() {
            var defer=$q.defer();

            $http.get('medical_nurse/analyzes/getAllNotReadyAnalyzes')
                .success(function(inpatients) {
                    defer.resolve(inpatients);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function postAnalysesResult(date, id) {
            var defer=$q.defer();
            date.analyses_id = id;
            $http.post('medical_nurse/analyzes/addAnalysisResult',date)
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
            getAllNotReadyAnalyzes: getAllNotReadyAnalyzes,
            postAnalysesResult:postAnalysesResult
        };

    });



