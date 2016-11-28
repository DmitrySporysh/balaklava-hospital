angular
 .module('doctorApp')
    .service('DoctorEmergencyPersonService', function($http, $q) {

        function getInfoFromEmergency(id) {
            var defer=$q.defer();

            $http.get('api/doctor/emergency/received_patient/'+id)
                .success(function(patients) {
                    defer.resolve(patients);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        function getDepartments(id) {
                    var defer=$q.defer();

                    $http.get('api/doctor/departments')
                        .success(function(patients) {
                            defer.resolve(patients);
                        })
                        .error(function(err) {
                            defer.reject(err);
                        });
                    return defer.promise;
                }

        function postInfoFromEmergency(patientInfo, id) {
            patientInfo.id = id;
            var defer=$q.defer();

            $http.post('api/doctor/emergency/addNewInspectionProtocol',patientInfo)
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        return {
            getDepartments: getDepartments,
            getInfoFromEmergency: getInfoFromEmergency,
            postInfoFromEmergency: postInfoFromEmergency
        };

    });

