angular
 .module('doctorApp')
    .directive('emergencyPerson', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/emergency_person/emergency_p.html",
            controller: 'DoctorEmergencyPersonCtrl',
            controllerAs: 'doctorEmPersonCtrl'
        };
    });


