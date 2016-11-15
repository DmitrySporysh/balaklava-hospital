angular
    .module('headPhysicianApp', ['ui.router'])
    .constant('PATHDIR', 'development/app/HeadPhysician')
    .config(function($stateProvider) { //Because $stateProvider is an Angular Provider, you must inject it into a .config() block using Angular 1 Dependency Injection.
        $stateProvider
            .state('inpatients',{
                url: '/inpatients',
                template: '<inpatients></inpatients>'
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
        
    });




