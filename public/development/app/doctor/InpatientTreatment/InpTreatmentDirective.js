angular
 .module('doctorApp')
    .directive('InpatientTreatment', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/InpatientTreatment/InpTreatment.html",
            controller: 'InpatientsCtrl',
            controllerAs: 'inpatientsCtrl'
        };
    });


