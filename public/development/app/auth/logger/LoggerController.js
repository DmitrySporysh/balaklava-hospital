angular
    .module('authApp')
        .controller('LoginCtrl', function(loginService, $sessionStorage) {
            var self = this;

            this.login = function() {
                loginService.login(this.login_info.login, this.login_info.password)
                    .then (function(access) {
                        if (access.success) {
                            loginService.cahngeSessionInfo();
                            console.log($sessionStorage);

                            loginService.redirection();
                        }
                    });
            };
        });