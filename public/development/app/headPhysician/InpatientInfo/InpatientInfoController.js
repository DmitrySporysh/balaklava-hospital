angular
    .module('headPhysicianApp')
    .controller('InpatientInfoCtrl', function(InpatientInfoService, $stateParams) {
        var self = this;
        self.emPerson_id = $stateParams.id;

        InpatientInfoService.getInpatients()
            .then(function(inpatients) {
                self.inpatients = inpatients.data;
            });

        self.getDoctorList = function (){
            InpatientInfoService.getDoctors()
                .then(function(response) {
                    self.doctorList = response.data;
                });
        };

        self.getDepartments = function (){
            InpatientInfoService.getDepartments()
                .then(function(response) {
                    self.departments = response;
                });
        };

        self.getHospitals = function (){
            InpatientInfoService.getHospitals()
                .then(function(response) {
                    self.hospitals = response;
                });
        };

        self.designateTheDoctor = function (){
            InpatientInfoService.designateTheDoctor(self.designate_the_doctor, self.emPerson_id)
                .then(function(response) {
                    self.response = response;
                    console.log(self.response);
                });
        };

        self.WriteOutPatient = function (){
            InpatientInfoService.writeOutPatient(self.write_out_patient, self.emPerson_id)
                .then(function(response) {
                    self.response = response;
                    console.log(self.response);
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