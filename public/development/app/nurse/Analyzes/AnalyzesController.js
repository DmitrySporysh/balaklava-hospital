angular
    .module('nurseApp')
    .controller('AnalyzesCtrl', function($scope,$http, AnalyzesService, FileUploader) {
        var self = this;

        AnalyzesService.getAllNotReadyAnalyzes()
            .then(function(analyses) {
                self.analyses = analyses;
            });

        self.setShownAnalyses = function (index) {
            self.index = index;
            self.analyses_id = self.analyses[index].analyses_id;
        };


        var fd = new FormData();
        $scope.uploadavtar = function(files) {
            fd.append("file", files[0]);
        };

        self.postAnalysesResult = function () {


            fd.append('analyses_id', self.analyses_id);

            for (key in self.analysesResult) {
                fd.append(key, self.analysesResult[key]);
            }

            $http.post("api/medical_nurse/analyzes/addAnalysisResult", fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).then(function successCallback(response) {
            }, function errorCallback(response) {
            });
        }
    });
