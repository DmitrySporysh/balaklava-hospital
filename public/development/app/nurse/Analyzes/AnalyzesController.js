angular
    .module('nurseApp')
    .controller('AnalyzesCtrl', function(AnalyzesService) {
        var self = this;

        AnalyzesService.getAllNotReadyAnalyzes()
            .then(function(patients) {
                self.received_patients = patients.data;
                console.log(patients.data);
            });
    });
