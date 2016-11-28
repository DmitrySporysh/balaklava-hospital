angular
    .module('nurseApp')
    .directive('archive', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/archive/archive.html",
            controller: 'ArchiveCtrl',
            controllerAs: 'archiveCtrl'
        };
    });
