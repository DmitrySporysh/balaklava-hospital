var emergencyRoomAppControllers = angular.module('bookWishlistAppControllers', []);

emergencyRoomAppControllers.controller('LoginController', ['$scope', '$http', function ($scope, $http) {

}]);

emergencyRoomAppControllers.controller('SignupController', ['$scope', '$http', function ($scope, $http) {

}]);

emergencyRoomAppControllers.controller('MainController', ['$scope', '$http', function ($scope, $http) {

    $http.get('/patientsFio').success(function(patientsFio) {

        $scope.patientsFio = patientsFio;
    })


}]);