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
            controller: 'InpatientTreatmentCtrlDynamic',
             controllerAs: 'treatmentDynamic'
        };
    })
    .directive('prescriptions', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/InpatientTreatment/tabs/prescriptions.html",
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
