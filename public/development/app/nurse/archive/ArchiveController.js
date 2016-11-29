
angular
    .module('nurseApp')
    .controller('ArchiveCtrl', function(ArchiveService) {
        var self = this;

        ArchiveService.getArchivePeople()
            .then(function (people) {
                self.archivePeople = people.data;
                console.log(people.data);
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


/*$scope.change = function() {
 console.log($scope.filter);
 $http({method:'GET', url:'/doctor/archive', params: $scope.filter})
 .success(function (answ) {
 $scope.response=answ;
 console.log(answ);
 });
 };*/