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

        var fd=new FormData();
        self.postAnalysesResult = function () {
            fd.append('file',self.file);
            fd.append("date",JSON.stringify(self.analysesResult));
            /*console.log(fd);*/
            /*AnalyzesService.postAnalysesResult(this.analysesResult, self.analyses_id);*/
            AnalyzesService.postAnalysesResult(fd, self.analyses_id);
        }
    });
