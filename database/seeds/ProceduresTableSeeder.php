<?php

use Illuminate\Database\Seeder;

class ProceduresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $procedures = [
            'Кардиологический стресс-тест',
            'Электрокардиография',
            'Электроэнцефалография',
            'Электрокортикография',
            'Электромиография',
            'Электронейронография',
            'Электронистагмография',
            'Эндоскопия',
            'Колоноскопия',
            'Кольпоскопия',
            'Цистоскопия',
            'Гастроскопия',
            'Ларингоскопия',
            'Офтальмоскопия',
            'Отоскопия',
            'Эзофагоманометрия',
            'Вызванный потенциал',
            'Магнитоэнцефалография',
            'Медицинская визуализация'
        ];


        foreach (range(1, 40) as $index) {
            foreach (range(1, count($procedures)) as $day)
                DB::table('procedures')->insert([

                    'appointment_date' => '2016-10-' . (($day + 1) % 30 + 1),
                    'ready_date' => '2016-10-' . (($day + 3) % 30 + 1),
                    'procedure_name' => $procedures[$day-1],
                    'procedure_description' => '..описание процедуры №'.$day,
                    'inpatient_id' => $index,
                    'doctor_who_appointed' => 2 + 3 * (($index + $day) % 10) + 17,
                    'doctor_who_performed' => 2 + 3 * (($index + $day + 2) % 10) + 17,
                    'paths_to_files' => 'procedures/'.$day.'.jpg'
                ]);
        }
    }
}
