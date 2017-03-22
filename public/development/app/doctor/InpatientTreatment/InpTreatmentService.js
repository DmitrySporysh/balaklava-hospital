angular
 .module('doctorApp')
    .service('InpatientTreatmentService', function($http, $q) {

        function getGeneralInfo(id) {
            var defer=$q.defer();

            $http.get('api/doctor/inpatient/'+id)
                .success(function(generalInfo) {
                    defer.resolve(generalInfo);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            
            return defer.promise;
        }

        function getAnalyzes(id) {
            var defer=$q.defer();

            $http.get('api/doctor/inpatient/'+id+'/analyzes')
                .success(function(analyzes) {
                    defer.resolve(analyzes);
                })
                .error(function(err) {
                    defer.reject(err);
                });

            return defer.promise;
        }

        function getInspections(id) {
            var defer=$q.defer();

            $http.get('api/doctor/inpatient/'+id+'/statesDynamics')
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
                console.log(defer.promise);
            return defer.promise;
        }

        function getProcedures(id) {
            var defer=$q.defer();

            $http.get('api/doctor/inpatient/'+id+'/procedures')
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function getOperations(id) {
            var defer=$q.defer();

            $http.get('api/doctor/inpatient/'+id+'/operations')
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function getPrescriptions(id) {
            var defer=$q.defer();

            $http.get('api/doctor/inpatient/'+id+'/medical_appointments')
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function getInspectionProtocol(id) {
            var defer=$q.defer();

            $http.get('api/doctor/inpatient/'+id+'/inspection_protocol')
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function newAnalysis(id, analysisInfo) {
            var defer=$q.defer();
            analysisInfo.inpatient_id = id;

            $http.post('api/doctor/inpatient/addAnalysis',analysisInfo)
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function newCondition(id, data) {
            var defer=$q.defer();
            data.inpatient_id = id;

            $http.post('api/doctor/inpatient/addInspection',data)
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function newProcedure(id, data) {
            var defer=$q.defer();
            data.inpatient_id = id;

            $http.post('api/doctor/inpatient/addProcedure',data)
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function newOperation(id, data) {
            var defer=$q.defer();
            data.inpatient_id = id;

            $http.post('api/doctor/inpatient/addOperation',data)
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function newPrescription(id, data) {
            var defer=$q.defer();
            data.inpatient_id = id;

            $http.post('api/doctor/inpatient/addMedicalAppointment',data)
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function lightColor (date) {
            if (date != null)
                return 'green';

            else
                return 'red';

        }

        return {
            getGeneralInfo: getGeneralInfo,
            getAnalyzes: getAnalyzes,
            getInspections: getInspections,
            getProcedures: getProcedures,
            getOperations: getOperations,
            getPrescriptions: getPrescriptions,
            getInspectionProtocol: getInspectionProtocol,
            newAnalysis: newAnalysis,
            newCondition: newCondition,
            newProcedure: newProcedure,
            newOperation: newOperation,
            newPrescription: newPrescription,
            lightColor: lightColor
        };

    });


