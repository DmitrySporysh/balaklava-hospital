angular
 .module('doctorApp')
    .directive('emergency', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/emergency/emergency.html",
            controller: 'DoctorEmergencyCtrl',
            controllerAs: 'doctorEmCtrl'
        };
    });


