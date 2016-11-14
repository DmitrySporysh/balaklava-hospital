angular
    .module('doctorApp', ['ui.router'])
    .constant('PATHDIR', 'development/app/doctor')
    .config(function($stateProvider) { //Because $stateProvider is an Angular Provider, you must inject it into a .config() block using Angular 1 Dependency Injection.
        $stateProvider
            .state('inpatients',{
                url: '/inpatients',
                template: '<inpatients></inpatients>'
            })
            .state('inpatient',{
                url: '/inpatient',
                template: '<inpatient></inpatient>'
            })
            .state('emergency',{
                url: '/emergency',
                template: '<emergency></emergency>'
            })
            .state('emergency_person',{
                url: '/emergency_person/:id',
                template: '<emergency-person></emergency-person>'
            });
    });

    


