angular
 .module('doctorApp')
    .controller('InpatientsCtrl', function(InpatientsService) {
        var self = this;

        InpatientsService.getInpatients()
            .then(function(inpatients) {
                self.inpatients = inpatients.data;
                console.log(inpatients);
            });
    });