<?php

use Illuminate\Database\Seeder;

class TemperatureLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hours = ['07', '15', '20'];

        foreach (range(1, 10) as $index) {
            foreach (range(1, 2) as $day)
                foreach ($hours as $hour)
                    DB::table('temperature_log')->insert([
                        'date' => '2016-10-' . ($day % 31 + 1).' '.$hour.':00:00',
                        'temperature_value' =>  round(rand(3630, 3890) / 100, 1),
                        'inpatient_id' => $index,
                        'doctor_id' => 2 + 3 * (($index + $day) % 10) + 17,
                    ]);
        }
    }
}
