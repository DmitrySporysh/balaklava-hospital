angular
 .module('emergencyApp')
    .controller('ReceivedPatientsCtrl', function(ReceivedPatientsService) {
        var self = this;

        ReceivedPatientsService.getRecievedPatients()
            .then(function(patients) {
                self.received_patients = patients.data;
            });
    });
