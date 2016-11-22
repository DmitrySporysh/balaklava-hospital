angular
    .module('doctorApp')
    .directive('operations', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/Operations/Operations.html",
            controller: 'OperationsCtrl',
            controllerAs: 'operationsCtrl'
        };
    });


