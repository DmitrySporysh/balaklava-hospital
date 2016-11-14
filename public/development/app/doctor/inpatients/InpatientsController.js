angular
    .module('doctorApp')
    .controller('DoctorEmergencyCtrl', function(DoctorEmergencyService) {
        var self = this;

        DoctorEmergencyService.getEmergencyPeople()
            .then(function(people) {
                self.emergPeople = people.data;
            });
    });