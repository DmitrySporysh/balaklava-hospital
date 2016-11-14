angular
 .module('doctorApp')
    .controller('InpatientTreatmentCtrl', function(InpatientTreatmentService, $stateParams) {
        var self = this;

        self.emPerson_id = $stateParams.id;


    })

    .controller('InpatientTreatmentCtrlGeneral', function(InpatientTreatmentService, $stateParams) {
        var self = this;

        self.emPerson_id = $stateParams.id;

        InpatientTreatmentService.getGeneralInfo(self.emPerson_id)
            .then(function(generalInfo){
                self.generalInfo = generalInfo[0];
            });
    })

    .controller('InpatientTreatmentCtrlAnalyzes', function(InpatientTreatmentService, $stateParams) {
        var self = this;

        self.emPerson_id = $stateParams.id;

        InpatientTreatmentService.getAnalyzes(self.emPerson_id);
           /* .then(function(generalInfo){
         self.generalInfo = generalInfo[0];
         console.log(self.generalInfo);
         });*/
    });



