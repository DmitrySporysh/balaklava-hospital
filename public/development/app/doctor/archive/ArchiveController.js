angular
    .module('doctorApp')
    .controller('ArchiveCtrl', function(ArchiveService) {
        var self = this;

        self.test = function () {
            ArchiveService.getArchivePeople()
                .then(function (people) {
                    self.emergPeople = people.data;
                    console.log(people.data);
                });
        };

        ArchiveService.getArchivePeople()
            .then(function (people) {
                self.archivePeople = people.data;
            });
    });