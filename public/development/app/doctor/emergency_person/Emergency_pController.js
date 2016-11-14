angular
 .module('doctorApp')
    .controller('DoctorEmergencyPersonCtrl', function($scope, $http, $stateParams, DoctorEmergencyPersonService) {
        var self = this;

        self.emPerson_id = $stateParams.id;


        $http.get('doctor/received_patient/240').success(function(patients) {
            $scope.patient_info = patients[0];
            console.log($scope.patient_info);

        });


        /*DoctorEmergencyPersonService.getInfoFromEmergency(self.emPerson_id);*/
    });
