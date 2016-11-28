
angular
    .module('headPhysicianApp')
    .directive('archivePerson', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/Archive_person/ArchivePerson.html",
            controller: 'ArchivePersonCtrl',
            controllerAs: 'archivePersonCtrl'
        };
    });





