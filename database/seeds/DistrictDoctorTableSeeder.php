<?php

use Illuminate\Database\Seeder;

class DistrictDoctorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fio = array(
            'Иванов Иван Иванович', 'Петров Петр Петрович', 'Сидоров Иван Петрович'
        , 'Иванова Анна Ивановна', 'Петрова Анна Петровна', 'Сидорова Анна Павловна'
        , 'Сидорова Юлия Николаевна', 'Попова Юлия Николаевна', 'Петрова Екатерина Андреевна'
        , 'Кащук Павел Иванович', 'Закипелов Дмитрий Иванович', 'Попов Дмитрий Николаевич'
        , 'Староверов Павел Иванович', 'Староверов Анна Николаевна', 'Сидорова Юлий Павловна',
            'Карпов Петр Петрович'
        );

        foreach (range(1, 20) as $index) {
            DB::table('district_doctors')->insert([
                'fio' => $fio[$index % 15],
                'address' => 'г.Севастополь, ул.Ушакова №'.$index,
                'birth_date' => '1990-10-10',
                'hospital_id' => $index
            ]);
        }
    }
}
