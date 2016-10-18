<?php

use Illuminate\Database\Seeder;

class TreatmentsTableSeeder extends Seeder
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
                DB::table('treatments')->insert([
                    'treatment_name' => 'назначенное лечение №' . $index*$day,
                    'date' => '2016-10-'.$day,

                    'inpatient_id' => $index,
                    'doctor_id' => 4 * (($index % 3) + 1)
                ]);
            }
    }
}
