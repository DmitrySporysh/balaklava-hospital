<?php

use Illuminate\Database\Seeder;

class InspectionsTableSeeder extends Seeder
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
                DB::table('inspections')->insert([
                    'inspection_date' => '2016-10-'.$day,
                    'state_type' => ($day % 3 == 0) ? 'улучшилось' : 'ухудшилось',
                    'description_extended' => 'результат осмотра в виде текста \'все норм\'',
                    'inpatient_id' => $index,
                    'doctor_id' => 4 * (($index % 3) + 1)
                ]);
            }
    }
}
