var emergencyRoomAppControllers = angular.module('emergencyRoomAppControllers', []);

emergencyRoomAppControllers.controller('LoginController', ['$scope', '$http', function ($scope, $http) {

}]);

emergencyRoomAppControllers.controller('NewPatientController', ['$scope', '$http', function ($scope, $http) {

}]);

emergencyRoomAppControllers.controller('MainController', ['$scope', '$http', function ($scope, $http) {

    $scope.general=[{'header_title':'Поступившие больные'}];
    $http.get('/patientsFio').success(function(patientsFio) {
        $scope.patientsFio = patientsFio;
    });

    $scope.save = function (patient, NewPatient){
        $scope.response={};
        if(NewPatient.$valid){
            $http.post("/patient/addNew", patient).success(function (answ) {
                $scope.response=answ;
            });
        }
    };

}]);



var cookieStoreExample = angular.module('cookieStoreExample', ['ngCookies'])
    .controller('ExampleController', ['$cookieStore', function($cookieStore) {
        // Put cookie
        /*$cookieStore.put('myFavorite','oatmeal');*/
        // Get cookie
        var favoriteCookie = $cookieStore.get('temp');
        alert (favoriteCookie);
        // Removing a cookie
        /*$cookieStore.remove('myFavorite');*/
    }]);

