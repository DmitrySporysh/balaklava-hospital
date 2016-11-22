angular
    .module('nurseApp')
    .directive('analyzes', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/Analyzes/Analyzes.html",
            controller: 'AnalyzesCtrl',
            controllerAs: 'analyzesCtrl'
        };
    });


