angular
    .module('authApp')
    .controller('RegisterCtrl', function(RegisterService, $sessionStorage) {
        var self = this;


        self.register = function () {
            RegisterService.registration(self.register_info)
                .then (function(access) {
                    self.answer = access;
                });
        };

    });