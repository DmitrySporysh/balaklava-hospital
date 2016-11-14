angular
 .module('doctorApp')
    .directive('inpatientTreatment', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/InpatientTreatment/InpTreatment.html",
            controller: 'InpatientTreatmentCtrl',
            controllerAs: 'inpatientTreatmentCtrl'
        };
    })


/*tabs*/

    .directive('general', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/InpatientTreatment/tabs/general.html",
            controller: 'InpatientTreatmentCtrlGeneral',
            controllerAs: 'treatmentGeneral'
        };
    })
    .directive('analyzes', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/InpatientTreatment/tabs/analyzes.html",
            controller: 'InpatientTreatmentCtrlAnalyzes',
             controllerAs: 'treatmentAnalyzes'
        };
    })
    .directive('dynamic', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/InpatientTreatment/tabs/dynamic.html",
            /*controller: 'InpatientTreatmentCtrl',
             controllerAs: 'inpatientTreatmentCtrl'*/
        };
    })
    .directive('recipes', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/InpatientTreatment/tabs/recipes.html",
            /*controller: 'InpatientTreatmentCtrl',
             controllerAs: 'inpatientTreatmentCtrl'*/
        };
    })
    .directive('inspections', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/InpatientTreatment/tabs/inspections.html",
            /*controller: 'InpatientTreatmentCtrl',
             controllerAs: 'inpatientTreatmentCtrl'*/
        };
    });
