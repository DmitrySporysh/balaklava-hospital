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
            return defer.promise;
        }

        function postAnalysesResult(analysesInfo) {
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
            getAllNotReadyAnalyzes: getAllNotReadyAnalyzes,
            postAnalysesResult:postAnalysesResult
        };

    });



