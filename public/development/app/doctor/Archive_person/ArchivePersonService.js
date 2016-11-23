angular
    .module('doctorApp')
    .service('archivePersonService', function($http, $q) {

        function getPersonInfo(id) {
            var defer=$q.defer();

            $http.get('doctor/getInpatientAllInfo/'+id)
                .success(function(patients) {
                    defer.resolve(patients);

                })
                .error(function(err) {
                    defer.reject(err);
                });
            return defer.promise;
        }

        return {
            getPersonInfo: getPersonInfo
        };

    });



/*
 doctorAppControllers.controller('ArchivePatientController', function ($scope, $http, testFactory) {

 $scope.testFactory=testFactory;

 var date_comp={
 'analyzes':'appointment_date',
 'inpatient_info':'start_date',
 'inspection_protocol':'date',
 'inspections':'inspection_date',
 'medical_appointments':'date',
 'operations':'appointment_date',
 'procedures':'procedure_date'
 };
 var name_comp={
 'analyzes':'analysis_name',
 'inpatient_info':'fio',
 'inspection_protocol':'complaints',
 'inspections':'description_extended',
 'medical_appointments':'description',
 'operations':'operation_name',
 'procedures':'procedure_name'
 };

 var type_comp={
 'analyzes':'Анализ',
 'inpatient_info':'Информ???',
 'inspection_protocol':'Протокол',
 'inspections':'Осмотр',
 'medical_appointments':'Назначение',
 'operations':'Операция',
 'procedures':'Процедура'
 };

 $scope.name_comp=name_comp;
 $scope.type_comp=type_comp;
 $scope.date_comp=date_comp;

 $http.get('doctor/getInpatientAllInfo/'+$scope.testFactory.inpatient_number).success(function(ans) {
 $scope.full_info = ans;

 var sort_date=[];
 var date_to_in;

 for (block in ans) {
 for (row in ans[block]) {
 var date = ans[block][row][date_comp[block]];//Это вывод даты, т.е.  имена разные , то приходится делать вот такой мусор
 /!*console.log(date);*!/

 sort_date.push({
 'block':block,
 'row':row,
 'date':date});
 }
 }

 /!* console.log(sort_date);*!/

 for (item in sort_date)
 {
 date_to_in=sort_date[item]['date'];
 date_to_in=date_to_in.replace(/-/g, "").replace(/:/g, "").replace(" ", "");
 date_to_in=parseInt(date_to_in);

 sort_date[item]['date']=date_to_in;
 }

 sort_date = sort_date.sort(function (b, a) {
 return (b.date - a.date)
 });

 $scope.date_sort=sort_date;

 /!*console.log(sort_date);*!/
 });


 });*/


