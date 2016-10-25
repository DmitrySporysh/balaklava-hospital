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
            'Электронейронография ',
            'Электронистагмография ',
            'Электроокулография',
            'Электроретинография',
            'Эндолюминальнальный мониторинг с помощью капсул',
            'Эндоскопия',
            'Колоноскопия',
            'Кольпоскопия',
            'Цистоскопия',
            'Гастроскопия',
            'Лапароскопия',
            'Ларингоскопия',
            'Офтальмоскопия',
            'Отоскопия',
            'Ректороманоскопия',
            'Эзофагоманометрия',
            'Вызванный потенциал',
            'Магнитоэнцефалография',
            'Медицинская визуализация'
        ];


        foreach (range(1, 40) as $index) {
            foreach (range(1, ( $index % count($procedures)) ) as $day)
                DB::table('procedures')->insert([
                    'procedure_date' => '2016-10-' . ($day % 31 + 1),
                    'procedure_name' => $procedures[$day],
                    'procedure_description' => '..описание процедуры №'.$day,
                    'inpatient_id' => $index,
                    'doctor_id' => 2 + 3 * (($index + $day) % 10) + 17,
                ]);
        }
    }
}
