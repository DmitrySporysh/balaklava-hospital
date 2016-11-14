angular
 .module('doctorApp')
    .controller('DoctorEmergencyPersonCtrl', function($stateParams, DoctorEmergencyPersonService) {
        var self = this;

        self.emPerson_id = $stateParams.id;

        DoctorEmergencyPersonService.getInfoFromEmergency(self.emPerson_id);
    });
