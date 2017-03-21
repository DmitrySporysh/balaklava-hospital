<?php

use Illuminate\Database\Seeder;

class StateDynamicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $description_extended = [
            'Улучшелось. Мы выяснили это, просто поверив ему наслово',
            'Ухудшелось. Наблюдая за состоянием пациента и его общим самочувствием, отмечаются значительные ухудшения: 
            он не хочет есть, плохо спит и т.д.',
        ];

        foreach (range(1, 5) as $day)
            foreach (range(1, 40) as $index) {
                DB::table('state_dynamic')->insert([
                    'date' => '2017-02-'.$day,
                    'description' => $description_extended[$index % 2],
                    'appointment' => "Прием такого-то припарата и следить за здоровьем",
                    'inpatient_id' => $index,
                    'doctor_id' => 2 + 3 * (($index + $day) % 10) + 17,
                ]);
            }
    }
}
