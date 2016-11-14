angular
    .module('doctorApp')
    .controller('DoctorEmergencyCtrl', function($scope,DoctorEmergencyService) {
        var self = this;

        DoctorEmergencyService.getEmergencyPeople()
            .then(function(people) {
                self.emergPeople = people.data;
            });
/*
        this.showEmerPerson = DoctorEmergencyService.EmerPersonInfo();*/
    });