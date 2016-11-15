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


/*--------------------------------------------------------tabs-----------------------------------------------------------------*/

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
            controllerAs: 'treatmentAnalyzes',
            /*compile: function(element, attributes){
                return {
                    pre: function(scope, element, attributes, controller){
                        var text = element.text();
                        element.text( ' Third' );
                    },
                    post: function(scope, element, attributes, controller){
                        var text = element.text();
                        element.text( ' Forth' );
                    }
                }
            }*/

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
            controller: 'InpatientTreatmentCtrlPrescr',
             controllerAs: 'treatmentPrescr'
        };
    })
    .directive('firstInspect', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/InpatientTreatment/tabs/first_inspect.html",
            controller: 'InpatientTreatmentFirstInspect',
             controllerAs: 'inpatientTreatmentFirstInspect'
        };
    });
