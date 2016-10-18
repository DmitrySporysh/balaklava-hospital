<?php

use Illuminate\Database\Seeder;

class ReceivedPatientsTableSeeder extends Seeder
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

        $received_types = array('плановое', 'эксренное', 'по скорой', 'другое');
        $marital_status = array('в браке', 'не в браке');

        foreach (range(1, 20) as $index) {
            DB::table('received_patients')->insert([
                'patient_id' => $index,
                'registration_nurse_id' => 1 + ((($index - 1) % 4) * 4),
                'fio' => $fioMale[$index % 10],
                'marital_status' => $marital_status[$index % 2],
                'received_date' => '2016-10-'. ($index % 30 + 1),
                'work_place' => 'Пациенту явно плохо',
                'residential_address' => 'г.Севастополь, ул.Вакуленчука №'.$index,
                'registration_address' => 'г.Севастополь, ул.Гагарина №'.$index,
                'phone' => '797800007'.($index % 10 * 10),
                'complaints' => 'у пацинта что-то болит. Говорит "мне прям ваще фигово"',
                'received_type' => $received_types[$index % 4]
            ]);
        }

        foreach (range(21, 40) as $index) {
            DB::table('received_patients')->insert([
                'patient_id' => $index,
                'registration_nurse_id' => 1 + ((($index - 1) % 4) * 4),
                'fio' => $fioFemale[$index % 10],
                'marital_status' => $marital_status[$index % 2],
                'received_date' => '2016-10-'. ($index % 30 + 1),
                'work_place' => 'Пациенту явно плохо',
                'residential_address' => 'г.Севастополь, ул.Вакуленчука №'.$index,
                'registration_address' => 'г.Севастополь, ул.Гагарина №'.$index,
                'phone' => '797800007'.($index % 10 * 10),
                'complaints' => 'у пацинта что-то болит. Говорит "мне прям ваще фигово"',
                'received_type' => $received_types[$index % 4]
            ]);
        }
    }
}
