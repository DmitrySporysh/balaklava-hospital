angular
    .module('doctorApp')
    .controller('DoctorEmergencyCtrl', function(loginService, $sessionStorage) {
        var self = this;

        this.login = function() {
            loginService.login(this.login_info.login, this.login_info.password)
                .then (function(access) {
                    if (access.success) {
                        loginService.cahngeSessionInfo();
                        loginService.redirection();
                    }
                });
        };
    });