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
                console.log(self.generalInfo);
            });
    })

    .controller('InpatientTreatmentCtrlAnalyzes', function(InpatientTreatmentService, $stateParams) {
        var self = this;
        self.emPerson_id = $stateParams.id;
        self.counter =0;

        InpatientTreatmentService.getAnalyzes(self.emPerson_id)
            .then(function(analyzes){
                 self.analyzes = analyzes;
             });

        self.new_analysis = function (){
            InpatientTreatmentService.newAnalysis(self.emPerson_id, self.analysisInfo)
                .then(function(response) {
                    self.response = response;
                    self.analyzes.unshift(response['data']);
                });
        };

        self.setShownAnalyses = function (analysis_id){
            self.shownAnalyses = self.analyzes[analysis_id-1];
        };

        self.lightColor = function (dateReady) {
            return InpatientTreatmentService.lightColor(dateReady);
        }
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
            });

        self.newCondition = function (){
            InpatientTreatmentService.newCondition(self.emPerson_id, self.condition)
                .then(function(response) {
                    self.inspections.unshift(response['data']);
                });
        };

        self.newOperation = function (){
            InpatientTreatmentService.newOperation(self.emPerson_id, self.operation)
                .then(function(response) {
                    self.operations.unshift(response['data']);
                });
        };

        self.newProcedure = function (){
            InpatientTreatmentService.newProcedure(self.emPerson_id, self.procedure)
                .then(function(response) {
                    self.procedures.unshift(response['data']);
                });
        };

        self.setShownProcedure = function (procedure_id){
            self.shownProcedure = self.procedures[procedure_id-1];
        };
    })

    .controller('InpatientTreatmentCtrlPrescr', function(InpatientTreatmentService, $stateParams) {
        var self = this;
        self.emPerson_id = $stateParams.id;

        InpatientTreatmentService.getPrescriptions(self.emPerson_id)
            .then(function(prescriptions){
                self.prescriptions = prescriptions;
            });

        self.newPrescription = function (){
            InpatientTreatmentService.newPrescription(self.emPerson_id, self.prescription)
                .then(function(response) {
                    self.response = response;
                    self.prescriptions.unshift(response['data']);
                });
        };
    })
    
    .controller('InpatientTreatmentFirstInspect', function(InpatientTreatmentService, $stateParams) {
        var self = this;
        self.emPerson_id = $stateParams.id;
    
        InpatientTreatmentService.getInspectionProtocol(self.emPerson_id)
            .then(function(firstInsp){
                self.firstInsp = firstInsp[0];
            });
    });



