angular
    .module('authApp')
        .service('loginService', function($http, $sessionStorage, $window, $q) {

            function login(login, password) {
                var info = {login: login, password: password};
                var defer=$q.defer();

                $http.post("/login", info)
                    .success(function (answ) {
                        defer.resolve(answ);
                    }).error(function(err) {
                        defer.reject(err);
                    });

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

            function redirection() {
                if (getPost() == 'Врач') {
                    $window.location.href =  "/doctor";
                }
                if (getPost()  == 'Приемный') {
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