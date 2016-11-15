angular
 .module('headPhysicianApp')
    .directive('inpatientInfo', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/inpatientInfo/inpatientInfo.html",
            controller: 'InpatientInfoCtrl',
            controllerAs: 'inpatientInfoCtrl'
        };
    })
/*-----------------tabs------------------*/
    .directive('general', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/inpatientInfo/tabs/general.html",
            controller: 'GeneralCtrl',
            controllerAs: 'generalCtrl'
        };
    });


