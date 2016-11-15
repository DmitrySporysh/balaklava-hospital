angular
    .module('headPhysicianApp')
    .controller('InpatientInfoCtrl', function(InpatientInfoService) {
        var self = this;

        InpatientInfoService.getInpatients()
            .then(function(inpatients) {
                self.inpatients = inpatients.data;
            });
    })
/*--------------tabs--------------*/
    .controller('GeneralCtrl', function(InpatientInfoService, $stateParams) {
        var self = this;
        self.person_id = $stateParams.id;

        InpatientInfoService.getGeneralInfo(self.person_id)
            .then(function(info) {
                self.inpatient_info = info[0];
                console.log(self.inpatient_info);
            });
    });