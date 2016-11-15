angular
    .module('nurseApp')
    .directive('newPatient', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/NewPatient/NewPatient.html",
            controller: 'NewPatientCtrl',
            controllerAs: 'newPatientCtrl'
        };
    });


