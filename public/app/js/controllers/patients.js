function PatientCtrn($scope, $http) {
    $http.get('/patientsFio').success(function(patientsFio) {
        $scope.patientsFio = patientsFio;
    })

    $scope.remaining = function() {
        var count = 0;

        angular.forEach($scope.patientsFio, function (patientsFio) {
            count+= patientsFio ? 0 : 1;
        })
    }
}