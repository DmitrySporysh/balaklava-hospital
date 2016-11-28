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

        $scope.uploadavtar = function(files) {
            var fd = new FormData();
            fd.append("file", files[0]);

            for (key in self.analysesResult) {
                fd.append(key, self.analysesResult[key]);
            }

            $http.post("api/medical_nurse/analyzes/addAnalysisResult", fd, {
                withCredentials: true,
                headers: {'Content-Type': undefined },
                transformRequest: angular.identity
            }).then(function successCallback(response) {
                console.log(response);
            }, function errorCallback(response) {
                console.log(response);
            });

        };

        self.postAnalysesResult = function () {
            
            /*console.log(self.analysesResult);*/
            /*AnalyzesService.postAnalysesResult(this.analysesResult, self.analyses_id);*/
        /*    AnalyzesService.postAnalysesResult(fd, self.analyses_id);*/
        }
    });
