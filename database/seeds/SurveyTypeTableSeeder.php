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
        foreach (range(1, 30) as $index) {
            DB::table('surveys_types')->insert([
                'survey_name' => 'Тип обследования №'.$index,
                'description' => 'Тут д.б. описания данног типа обследования №'.$index,
                'room_number' => '№'.$index
            ]);
        }
    }
}
