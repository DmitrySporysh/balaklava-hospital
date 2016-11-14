angular
    .module('authApp', ['ui.router', 'ngStorage'])
    .constant('PATHDIR', 'development/app/auth')
    .config(function($stateProvider) { //Because $stateProvider is an Angular Provider, you must inject it into a .config() block using Angular 1 Dependency Injection.
        $stateProvider
            .state('login',{
                url: '/login',
                template: '<login-form></login-form>'
            })
            .state('registration',{
                url: '/registration',
                template: '<registration></registration>'
            });
    });

    


