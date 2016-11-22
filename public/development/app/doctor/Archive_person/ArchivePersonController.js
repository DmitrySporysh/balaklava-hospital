angular
    .module('doctorApp')
    .controller('ArchivePersonCtrl', function(archivePersonService, $stateParams) {
        var self = this;

        self.archPerson_id = $stateParams.id;

        self.temp = archivePersonService.getPersonInfo(self.archPerson_id);

    });