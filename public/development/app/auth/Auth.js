angular
    .module('auth', ['ui.router'])
    .constant('PATHDIR', 'development/app/auth')
    .config(function($stateProvider) { //Because $stateProvider is an Angular Provider, you must inject it into a .config() block using Angular 1 Dependency Injection.
        $stateProvider
            .state('login',{
                url: '/login',
                /*template: '<login-form></login-form>'*/
                template: '<h1>123</h1>'
            })
            .state('registration',{
                url: '/registration',
                template: '<bew-d></bew-d>'
            });
    });

    


