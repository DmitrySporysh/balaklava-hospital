angular
    .module('nurseApp')
    .service('AnalyzesService', function($http, $q) {

        function getAllNotReadyAnalyzes() {
            var defer=$q.defer();

            $http.get('api/medical_nurse/analyzes/getAllNotReadyAnalyzes')
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
            $http.post('api/medical_nurse/analyzes/addAnalysisResult',date)
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });

        }


        return {
            getAllNotReadyAnalyzes: getAllNotReadyAnalyzes,
            postAnalysesResult:postAnalysesResult
        };

    });



