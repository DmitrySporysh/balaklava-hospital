angular
    .module('authApp')
    .service('RegisterService', function($http, $sessionStorage, $window, $q) {

        function login(login, password) {
            var info = {login: login, password: password};
            var defer=$q.defer();

            $http.post("/login", info)
                .success(function (answ) {
                    defer.resolve(answ);
                }).error(function(err) {
                defer.reject(err);
            });
            console.log(defer.promise);
            return defer.promise;
        }

        function cahngeSessionInfo() {
            $sessionStorage.$reset({
                name: sessionStorage.getItem('fio'),
                post: sessionStorage.getItem('post'),
            });
        }

        function getPost() {
            return $sessionStorage.post;
        }

        function redirection(post) {
            if (post == 'Врач') {
                $window.location.href =  "/doctor#/emergency";
            }
            if (post  == 'Приемный') {
                $window.location.href =  "/emergency";
            }
        }

        return {
            login: login,
            redirection: redirection,
            getPost: getPost,
            cahngeSessionInfo: cahngeSessionInfo
        };

    });