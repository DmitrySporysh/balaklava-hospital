angular
    .module('doctorApp')
    .controller('ArchivePersonCtrl', function($scope, archivePersonService, $stateParams) {
        var self = this;

        self.archPerson_id = $stateParams.id;

        self.date_comp={
            'analyzes':'appointment_date',
            'inpatient_info':'start_date',
            'inspection_protocol':'date',
            'inspections':'inspection_date',
            'medical_appointments':'date',
            'operations':'appointment_date',
            'procedures':'procedure_date'
        };
        self.name_comp={
            'analyzes':'analysis_name',
            'inpatient_info':'fio',
            'inspection_protocol':'complaints',
            'inspections':'description_extended',
            'medical_appointments':'description',
            'operations':'operation_name',
            'procedures':'procedure_name'
        };
        self.type_comp={
            'analyzes':'Анализ',
            'inpatient_info':'Информ???',
            'inspection_protocol':'Протокол',
            'inspections':'Осмотр',
            'medical_appointments':'Назначение',
            'operations':'Операция',
            'procedures':'Процедура'
        };

        var sort_date=[];
        var date_to_in;


        archivePersonService.getPersonInfo(self.archPerson_id)
            .then(function(data) {
                self.full_info =  data;
                console.log(data);

                for (block in self.full_info){
                    for (row in self.full_info[block]){
                        var date = self.full_info[block][row][self.date_comp[block]];

                        sort_date.push({
                            'block':block,
                            'row':row,
                            'date':date});
                    }
                }

                for (item in sort_date)
                {
                    date_to_in=sort_date[item]['date'];

                    if (date_to_in !=undefined) {
                        date_to_in=date_to_in.replace(/-/g, "").replace(/:/g, "").replace(" ", "");
                        date_to_in=parseInt(date_to_in);
                    }
                    sort_date[item]['date']=date_to_in;
                }


                sort_date = sort_date.sort(function (b, a) {
                    return (b.date - a.date)
                });

                self.date_sort=sort_date;
                console.log(self.date_sort);
            });
    });
