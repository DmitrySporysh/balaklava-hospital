angular
    .module('doctorApp')
    .controller('OperationsCtrl', function(OperationsService) {
        var self = this;

        OperationsService.getAllNotReadyOperations()
            .then(function(operations) {
                self.operations = operations;
                console.log(operations);
            });

        self.setShownAnalyses = function (id) {
            self.analyses_id = id;
        };

        self.postAnalysesResult = function (id) {
            self.analyses_id = id;
        }
    });
