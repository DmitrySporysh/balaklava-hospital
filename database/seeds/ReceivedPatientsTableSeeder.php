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
        $str = Storage::get('/public/patients.txt');
        $fios = explode("\r\n", $str);

        $received_types = array('плановое', 'эксренное', 'по скорой', 'другое');
        $marital_status = array('в браке', 'не в браке');

        foreach (range(1, 40) as $index) {
            DB::table('received_patients')->insert([
                'patient_id' => $index,
                'registration_nurse_id' => 1 + ((($index - 1) % 4) * 4),
                'fio' => $fios[$index-1],
                'marital_status' => $marital_status[$index % 2],
                'received_date' => '2016-10-'. ($index % 30 + 1),
                'work_place' => 'Фирма № '.($index % 8 + 1),
                'residential_address' => 'г.Севастополь, ул.Вакуленчука №'.$index,
                'registration_address' => 'г.Севастополь, ул.Гагарина №'.$index,
                'phone' => '797800007'.($index % 20 * 10),
                'complaints' => 'у пацинта что-то болит. Говорит "мне прям ваще фигово"',
                'received_type' => $received_types[$index % 4],
                'inspection_protocol_id' => $index
            ]);
        }

        foreach (range(41, 300) as $index) {
            DB::table('received_patients')->insert([
                'patient_id' => $index,
                'registration_nurse_id' => 1 + ((($index - 1) % 4) * 4),
                'fio' => $fios[$index - 1],
                'marital_status' => $marital_status[$index % 2],
                'received_date' => '2016-10-10 08:'.($index % 60).':00',
                'work_place' => 'Фирма № '.($index % 25 + 1),
                'residential_address' => 'г.Севастополь, ул.Вакуленчука №'.$index,
                'registration_address' => 'г.Севастополь, ул.Гагарина №'.$index,
                'phone' => '79781345'.($index * 10),
                'complaints' => 'у пацинта что-то болит. Говорит "мне прям ваще фигово"',
                'received_type' => $received_types[$index % 4]
            ]);
        }
    }
}
