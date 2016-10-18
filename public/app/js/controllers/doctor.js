var doctorAppControllers = angular.module('doctorAppControllers', []);

doctorAppControllers.directive('patientInfo', function () {

    /*var temp = function($scope, element, attrs) {
        $scope.$watch(attrs.patientInfo,function(value){
            element.text(value+attrs.habra);
        });
    };


  /*  return {
            templateUrl: "app/templates/doctor/patient_full/general.html"
        }*/

    /*return function($scope, element, attrs) {
        /!*Задаем функцию, которая будет вызываться при изменении переменной word, ее имя находится в attrs.habraHabr*!/
        $scope.$watch(attrs.patientInfo,function(value){
            console.log(attrs.template);

        });
    }*/

    /*return {
        link:function($scope, element, attrs) {
            /!*Задаем функцию, которая будет вызываться при изменении переменной word*!/
            $scope.$watch(attrs.patientInfo,function(value){
                console.log(attrs.template);
                $scope.test='liza';
            });
        },
        templateUrl: function ($scope, element, attrs) {
            console.log($scope.test);
            return "app/templates/doctor/patient_full/general.html";
        }
    }
*/
    return {
        templateUrl: "app/templates/doctor/patient_full/general.html"
    }
});

doctorAppControllers.controller('PatientFullController', ['$scope', '$http', function ($scope, $http) {


    $scope.area_change = function (template){
        $scope.response={};
        if(template=='results'){
                /*$http.post("/patient/addNew", patient).success(function (answ) {
                 $scope.response=answ;
                 });*/
                console.log('r');
            }
        if(template=='general'){
            console.log('g');
        }
        $scope.active_menu=template;
    };



}]);

doctorAppControllers.controller('EmergencyPersonController', ['$scope', '$http', function ($scope, $http) {

}]);

doctorAppControllers.controller('PatientsController', ['$scope', '$http', function ($scope, $http) {
    $http.get('doctor/inpatients').success(function(patients) {
        $scope.patients_info = patients.data;
    });
}]);


