<?php

use Illuminate\Database\Seeder;

class AnalyzesTableSeeder extends Seeder
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
                DB::table('analyzes')->insert([
                    'appointment_date' => '2016-10-'.$day,
                    'ready_date' => '2016-10-'.$day,
                    'description' => 'ЭКГ',
                    'result_description' => 'все норм',
                    'inpatient_id' => $index,
                    'doctor_id' => 4 * (($index % 3) + 1)
                ]);
            }
    }
}
