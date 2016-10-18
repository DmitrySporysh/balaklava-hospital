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
        foreach (range(1, 40) as $index) {
            DB::table('inpatients')->insert([
                'start_date' => '2016-10-'.($index % 30 + 1),
                'diagnosis' => 'Чем-то он явно болеет',
                'district_doctor_id' => $index % 20 + 1,
                'received_patient_id' => $index,
                'attending_doctor_id' => 2 + 4 * ($index % 4),
                'hospital_department_id' => $index % 20 + 1,
                'chamber_id' => $index % 6 + (10 * ceil($index / 10))
            ]);
        }
    }
}
