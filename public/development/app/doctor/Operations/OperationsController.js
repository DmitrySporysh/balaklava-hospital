angular
    .module('doctorApp')
    .controller('OperationsCtrl', function(OperationsService) {
        var self = this;

        OperationsService.getAllNotReadyOperations()
            .then(function(operations) {
                self.operations = operations;
            });

        self.setShownOperationIndex = function (index) {
            self.operation_index = index;
            self.operation_id = self.operations[index].operation_id;
        };

        self.addOperationResult = function () {
            OperationsService.addOperationResult(self.operationResult,self.operation_id);
        }
        
    });
