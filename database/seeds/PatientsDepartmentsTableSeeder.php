<?php

use Illuminate\Database\Seeder;

class PatientsDepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fioMale = array(
            'Иванов Иван Иванович', 'Петров Петр Петрович', 'Сидоров Иван Петрович'

        , 'Кащук Павел Иванович', 'Закипелов Дмитрий Иванович', 'Попов Дмитрий Николаевич'
        , 'Староверов Павел Иванович', 'Староверов Анна Николаевна', 'Сидорова Юлий Павловна',
            'Карпов Петр Петрович'
        );

        $fioFemale = array
        (
            'Иванова Анна Ивановна', 'Петрова Анна Петровна', 'Сидорова Анна Павловна'
        , 'Сидорова Юлия Николаевна', 'Попова Юлия Николаевна', 'Петрова Екатерина Андреевна',
            'Иванова Анна Ивановна', 'Петрова Анна Петровна', 'Сидорова Анна Павловна'
        , 'Сидорова Юлия Николаевна', 'Попова Юлия Николаевна'
        );

        foreach (range(1, 20) as $index) {
            DB::table('patients')->insert([
                'fio' => $fioMale[$index % 10],
                'sex' => 'male',
                'birth_date' => '1990-10-10',
                'receipt_date' => '2016-10-10',
                'initial_inspection' => 'Пациенту явно плохо',
                'preliminary_diagnosis' => 'Чем-то он явно болеет',
                'district_doctor_id' => $index,
                'attending_doctor_id' => 2 + 4 * ($index % 4),
                'hospital_department_id' => $index
            ]);
        }

        foreach (range(1, 20) as $index) {
            DB::table('patients')->insert([
                'fio' => $fioFemale[$index % 10],
                'sex' => 'female',
                'birth_date' => '1990-10-10',
                'receipt_date' => '2016-10-10',
                'initial_inspection' => 'Пациенту явно плохо',
                'preliminary_diagnosis' => 'Чем-то он явно болеет',
                'district_doctor_id' => $index,
                'attending_doctor_id' => 2 + 4 * ($index % 4),
                'hospital_department_id' => $index
            ]);
        }
    }
}
