angular
    .module('nurseApp')
    .controller('AnalyzesCtrl', function($scope, AnalyzesService, FileUploader) {
        var self = this;

        AnalyzesService.getAllNotReadyAnalyzes()
            .then(function(analyses) {
                self.analyses = analyses;
            });

        self.setShownAnalyses = function (index) {
            self.index = index;
            self.analyses_id = self.analyses[index].analyses_id;
        };

        self.uploader = new FileUploader({
            url: '/analyzes'
        });

        var fd=new FileUploader({
            url: 'test'
        });
        self.postAnalysesResult = function () {
            
            console.log(fd);
            /*AnalyzesService.postAnalysesResult(this.analysesResult, self.analyses_id);*/
            AnalyzesService.postAnalysesResult(fd, self.analyses_id);
        }
    });
