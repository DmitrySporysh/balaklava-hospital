angular
    .module('nurseApp')
    .controller('AnalyzesCtrl', function(AnalyzesService) {
        var self = this;

        AnalyzesService.getAllNotReadyAnalyzes()
            .then(function(analyses) {
                self.analyses = analyses;
            });

        self.setShownAnalyses = function (id) {
            self.analyses_id = id;
        };

        self.postAnalysesResult = function (id) {
            self.analyses_id = id;
        }
    });
