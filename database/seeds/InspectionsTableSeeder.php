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
        $description_extended = [
            'результат осмотра таков, что пациенту стало лучше. Мы выяснили это, просто поверив ему наслово',
            'наблюдая за состоянием пациента и его общим самочувствием, отмечаются значительные ухудшения: 
            он не хочет есть, плохо спит и т.д.',
        ];

        foreach (range(1, 5) as $day)
            foreach (range(1, 40) as $index) {
                DB::table('inspections')->insert([
                    'inspection_date' => '2016-10-'.$day,
                    'state_type' => ($day % 3 == 0) ? 'улучшилось' : 'ухудшилось',
                    'description_extended' => $description_extended[$index % 2],
                    'inpatient_id' => $index,
                    'doctor_id' => 4 * ((($day+$index) % 3) + 1)
                ]);
            }
    }
}
