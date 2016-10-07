<?php

use Illuminate\Database\Seeder;

class SurveysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 5) as $day)
            foreach (range(1, 40) as $index) {
                DB::table('surveys')->insert([
                    'survey_name' => 'обследовани №' . $index * $day,
                    'survey_date' => '2016-10-' . $day,
                    'status' => ($index % 2) ? true : false,
                    'result_text' => 'тут какой-то текст с результатом',
                    'result_file' => 'тут крепиться файл(картинка)с результатом, а может быть и не один файл, как надо будет',

                    'patient_id' => $index,
                    'doctor_id' => 4 * (($index % 3) + 1),
                    'survey_type_id' => ($index % 30) + 1
                ]);
            }
    }
}
