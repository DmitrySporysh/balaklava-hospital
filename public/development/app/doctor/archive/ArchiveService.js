angular
    .module('doctorApp')
    .service('ArchiveService', function($http, $q) {

        function getArchivePeople() {
            var defer=$q.defer();

            $http.get('api/doctor/archive')
                .success(function(patients) {
                    defer.resolve(patients);

                })
                .error(function(err) {
                    defer.reject(err);
                });
            console.log(defer.promise);
            return defer.promise;
        }

        function filtering(filter_info) {
            var defer=$q.defer();

            $http({method:'GET', url:'api/doctor/archive', params: filter_info})
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                });

            return defer.promise;
        }

        return {
            getArchivePeople: getArchivePeople,
            filtering: filtering
        };

    });

/*
 $http.get('doctor/archive').success(function(patients) {
 $scope.patients_info = patients.data;
 });

 $scope.testFactory=testFactory;
 $scope.follow_id = function (inpatient_number){
 $scope.testFactory.inpatient_number = inpatient_number;
 };

 $scope.change = function() {
 console.log($scope.filter);
 $http({method:'GET', url:'/doctor/archive', params: $scope.filter})
 .success(function (answ) {
 $scope.response=answ;
 console.log(answ);
 });
 };*/

