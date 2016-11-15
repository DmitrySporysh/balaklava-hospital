angular
    .module('emergencyApp')
    .controller('NewPatientCtrl', function(NewPatientService) {
        var self = this;

        self.saveEmergInfo = function (){
            NewPatientService.postGeneralEmergInfo(self.patient_info);
                /*.then(function(response) {
                    self.response = response;
                });*/
        };
    });
