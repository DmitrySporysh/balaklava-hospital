angular
    .module('headPhysicianApp', ['ui.router'])
    .constant('PATHDIR', 'development/app/headPhysician')
    .config(function($stateProvider) { //Because $stateProvider is an Angular Provider, you must inject it into a .config() block using Angular 1 Dependency Injection.
        $stateProvider
            .state('inpatients',{
                url: '/inpatients',
                template: '<inpatients></inpatients>'
            })
            .state('inpatient_info',{
                url: '/inpatients/:id',
                template: '<inpatient-info></inpatient-info>'
            })
                .state('inpatient_info.general',{
                    url: '/general',
                    template: '<general></general>'
                })

        
        
    });




