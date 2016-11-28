angular
 .module('doctorApp')
    .controller('DoctorEmergencyPersonCtrl', function($scope, $http, $stateParams, DoctorEmergencyPersonService) {
        var self = this;

        self.emPerson_id = $stateParams.id;


        DoctorEmergencyPersonService.getInfoFromEmergency(self.emPerson_id)
            .then(function(info) {
                self.patient_info = info[0];
            });

        DoctorEmergencyPersonService.getDepartments()
            .then(function(info) {
                self.departments = info;
            });

        self.saveProtocol = function (){
            DoctorEmergencyPersonService.postInfoFromEmergency(self.patientProtocol,self.emPerson_id)
                .then(function(response) {
                    self.response = response;
                });
        };

    });
