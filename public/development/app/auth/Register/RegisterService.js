angular
    .module('authApp')
    .service('RegisterService', function($http, $sessionStorage, $window, $q) {

        function registration(info) {
            var defer=$q.defer();

            $http.post("/register", info)
                .success(function (answ) {
                    defer.resolve(answ);
                }).error(function(err) {
                defer.reject(err);
            });
            console.log(defer.promise);
            return defer.promise;
        }

        return {
            registration: registration
        };

    });