angular
 .module('nurseApp')
    .directive('receivedPatients', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/ReceivedPatients/ReceivedPatients.html",
            controller: 'ReceivedPatientsCtrl',
            controllerAs: 'receivedPatientsCtrl'
        };
    });


