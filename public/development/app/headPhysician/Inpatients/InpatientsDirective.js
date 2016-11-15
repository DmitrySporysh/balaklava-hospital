angular
 .module('headPhysicianApp')
    .directive('inpatients', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/inpatients/inpatients.html",
            controller: 'InpatientsCtrl',
            controllerAs: 'inpatientsCtrl'
        };
    });


