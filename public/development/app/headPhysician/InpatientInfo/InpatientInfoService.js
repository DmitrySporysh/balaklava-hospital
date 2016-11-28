angular
 .module('headPhysicianApp')
    .service('InpatientInfoService', function($http, $q) {

        function getInpatients() {
            var defer=$q.defer();

            $http.get('api/department_chief/inpatients')
                .success(function(inpatients) {
                    defer.resolve(inpatients);

                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function getGeneralInfo(id) {
            var defer=$q.defer();

            $http.get('api/department_chief/inpatient/'+id)
                .success(function(generalInfo) {
                    defer.resolve(generalInfo);
                })
                .error(function(err) {
                    defer.reject(err);
                });

            return defer.promise;
        }

        function getDoctors() {
            var defer=$q.defer();

            $http.get('api/department_chief/doctors')
                .success(function(doctors) {
                    defer.resolve(doctors);
                })
                .error(function(err) {
                    defer.reject(err);
                });

            return defer.promise;
        }

        function getDepartments() {
            var defer=$q.defer();

            $http.get('api/department_chief/departments')
                .success(function(doctors) {
                    defer.resolve(doctors);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function getHospitals() {
            var defer=$q.defer();

            $http.get('api/department_chief/hospitals')
                .success(function(doctors) {
                    defer.resolve(doctors);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function designateTheDoctor(data, p_id) {
            var defer=$q.defer();

            data.inpatient_id = p_id;

            $http.post('api/department_chief/addAttendingDoctorToInpatient',data)
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function writeOutPatient(data, p_id) {
            var defer=$q.defer();

            data.inpatient_id = p_id;

            $http.post('api/department_chief/dischargeInpatient',data)
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        return {
            getInpatients: getInpatients,
            getGeneralInfo: getGeneralInfo,
            getDoctors: getDoctors,
            designateTheDoctor: designateTheDoctor,
            writeOutPatient: writeOutPatient,
            getDepartments: getDepartments,
            getHospitals: getHospitals
        };

    });