angular
    .module('nurseApp')
    .controller('AnalyzesCtrl', function($scope, AnalyzesService, FileUploader) {
        var self = this;

        self.uploader = new FileUploader({
            url: 'medical_nurse/analyzes/addAnalysisResult'
        });

        AnalyzesService.getAllNotReadyAnalyzes()
            .then(function(analyses) {
                self.analyses = analyses;
            });

        self.setShownAnalyses = function (index) {
            self.index = index;
            self.analyses_id = self.analyses[index].analyses_id;
        };

        self.postAnalysesResult = function () {


            console.log(self.uploader.queue);
/*
            AnalyzesService.postAnalysesResult(this.analysesResult, self.analyses_id);
*/
        }
    });
