angular
    .module('nurseApp', ['ui.router','ngMaterial','angularFileUpload'])
    .constant('PATHDIR', 'development/app/nurse')
    .config(function($stateProvider) { //Because $stateProvider is an Angular Provider, you must inject it into a .config() block using Angular 1 Dependency Injection.
        $stateProvider
            .state('null',{
                url: '',
                template: '<received-patients></received-patients>'
            })
            .state('received_patients',{
                url: '/received_patients',
                template: '<received-patients></received-patients>'
            })
            .state('new_patient',{
                url: '/new_patient',
                template: '<new-patient></new-patient>'
            })
            .state('analyzes',{
                url: '/analyzes',
                template: '<analyzes></analyzes>'
            })
            .state('archive',{
                url: '/archive',
                template: '<archive></archive>'
            })


            .state('inpatient_treatment',{
                url: '/inpatient_treatment/:id',
                template: '<inpatient-treatment></inpatient-treatment>'
            })
                .state('inpatient_treatment.general',{
                    url: '/general',
                    template: '<general></general>'
                })
                .state('inpatient_treatment.analyzes',{
                    url: '/analyzes',
                    template: '<analyzes></analyzes>'
                })
                .state('inpatient_treatment.dynamic',{
                    url: '/dynamic',
                    template: '<dynamic></dynamic>'
                })
                .state('inpatient_treatment.prescriptions',{
                    url: '/prescriptions',
                    template: '<prescriptions></prescriptions>'
                })
                .state('inpatient_treatment.first_inspect',{
                    url: '/inspections',
                    template: '<first-inspect></first-inspect>'
                })


    })
    .controller('nurseAppController', function (nurseAppService, $scope) {
        var self = this;

        $scope.logout = function () {
            nurseAppService.logout();
        }
    })
    .service('nurseAppService', function ($http, $q, $window) {

        function logout() {
            var defer=$q.defer();

            $http.post('/api/logout',{})
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                })
                .then(function(){
                    $window.location.href =  "/";
                });
            console.log(defer.promise);
        }

        return {
            logout: logout
        }

    });

    


