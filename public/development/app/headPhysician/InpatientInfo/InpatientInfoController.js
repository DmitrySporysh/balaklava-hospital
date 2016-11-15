angular
    .module('headPhysicianApp')
    .controller('InpatientInfoCtrl', function(InpatientInfoService) {
        var self = this;

        InpatientInfoService.getInpatients()
            .then(function(inpatients) {
                self.inpatients = inpatients.data;
            });

        self.getDoctorList = function (){
            InpatientInfoService.getDoctors()
                .then(function(response) {
                    self.doctorList = response;
                    console.log(response);
                });
        };
    })
/*--------------tabs--------------*/
    .controller('GeneralCtrl', function(InpatientInfoService, $stateParams) {
        var self = this;
        self.person_id = $stateParams.id;

        InpatientInfoService.getGeneralInfo(self.person_id)
            .then(function(info) {
                self.inpatient_info = info[0];
            });
    });