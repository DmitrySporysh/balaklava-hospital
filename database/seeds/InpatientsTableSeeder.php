<?php

use Illuminate\Database\Seeder;

class InpatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $beds_occupied_count = [5, 1, 1, 2, 2, 3, 3, 4, 4, 5];

        foreach (range(1, 40) as $index) {
            DB::table('inpatients')->insert([
                'start_date' => '2016-10-'.($index % 30 + 1),
                'diagnosis' => 'Чем-то он явно болеет',
                'district_doctor_id' => $index % 20 + 1,
                'received_patient_id' => $index,
                'attending_doctor_id' => 2 + 3 * ($index % 10) + 17,
                'hospital_department_id' => ((integer)(($index - 1) / 10)) + 1,
                'chamber_id' => $beds_occupied_count[$index % 10]  + (10 * (integer)(($index - 1) / 10.0))
            ]);
        }
    }
}
