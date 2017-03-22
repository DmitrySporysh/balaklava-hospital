angular
    .module('headPhysicianApp')
    .controller('ArchiveCtrl', function(ArchiveService) {
        var self = this;

        ArchiveService.getArchivePeople()
            .then(function (people) {
                self.archivePeople = people.data;
            });
        self.filter_info = {};
        self.filter_info.sort = "";

        self.change = function (sort) {
            self.filter_info.sort = sort;
            ArchiveService.filtering(self.filter_info)
                .then(function (people) {
                    self.archivePeople = people.data;
                });
        }
    });