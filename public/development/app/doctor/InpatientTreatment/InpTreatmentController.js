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

        InpatientTreatmentService.getAnalyzes(self.emPerson_id)
            .then(function(analyzes){
                 self.analyzes = analyzes;
             });
    })

    .controller('InpatientTreatmentCtrlDynamic', function(InpatientTreatmentService, $stateParams) {
        var self = this;
        self.emPerson_id = $stateParams.id;

        InpatientTreatmentService.getInspections(self.emPerson_id)
            .then(function(inspections){
                self.inspections = inspections;

            });
        InpatientTreatmentService.getProcedures(self.emPerson_id)
            .then(function(procedures){
                self.procedures = procedures;
            });
        InpatientTreatmentService.getOperations(self.emPerson_id)
            .then(function(operations){
                self.operations = operations;
                console.log(self.operations);
            });
    })
    .controller('InpatientTreatmentCtrlPrescr', function(InpatientTreatmentService, $stateParams) {
        var self = this;
        self.emPerson_id = $stateParams.id;

        InpatientTreatmentService.getPrescriptions(self.emPerson_id)
            .then(function(prescriptions){
                self.prescriptions = prescriptions;

            });
    });



