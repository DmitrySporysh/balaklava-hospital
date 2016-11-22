angular
    .module('nurseApp')
    .controller('AnalyzesCtrl', function(AnalyzesService) {
        var self = this;

        AnalyzesService.getAllNotReadyAnalyzes()
            .then(function(analyses) {
                self.analyses = analyses;
            });

        self.setShownAnalyses = function (index) {
            self.index = index;
            self.analyses_id = self.analyses[index].analyses_id;
        };

        self.postAnalysesResult = function () {
            AnalyzesService.postAnalysesResult(this.analysesResult, self.analyses_id);
        }
    });
