<?php

use Illuminate\Database\Seeder;

class SurveyTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 40) as $index) {
            DB::table('surveys_types')->insert([
                'survey_name' => 'Survey type №'.$index,
                'description' => 'It\'s type of survey with №'.$index,
                'room_number' => '№'.$index
            ]);
        }
    }
}
