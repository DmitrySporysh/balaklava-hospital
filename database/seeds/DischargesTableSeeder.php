<?php

use Illuminate\Database\Seeder;

class DischargesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $discharge_type = array('discharge', 'transfer', 'death', 'other');

        foreach (range(36, 40) as $index) {
            DB::table('discharges')->insert([
                'discharge_date' => '2016-10-' . $index - 15,
                'result_epicrisis' => 'пациент выписан в адекватном состоянии типа \'все норм\'',
                'discharge_type' => $discharge_type[0],
                'patient_id' => $index
            ]);
        }

        foreach (range(34, 35) as $index) {
            DB::table('discharges')->insert([
                'discharge_date' => '2016-10-' . $index - 15,
                'result_epicrisis' => 'пациент умер, т.к. было что-то то не норм',
                'discharge_type' => $discharge_type[2],
                'patient_id' => $index
            ]);
        }

        foreach (range(32, 33) as $index) {
            DB::table('discharges')->insert([
                'discharge_date' => '2016-10-' . $index - 15,
                'result_epicrisis' => 'пациент переведен в отделение №'.$index - 20 .'для дальнейшего обследоваия и лечения',
                'discharge_type' => $discharge_type[1],
                'patient_id' => $index,
                'discharge_department_id' => $index - 20
            ]);
        }

        foreach (range(30, 31) as $index) {
            DB::table('discharges')->insert([
                'discharge_date' => '2016-10-' . $index - 15,
                'result_epicrisis' => 'пациент переведен в больницу №'.$index - 20 .'для дальнейшего обследоваия и лечения',
                'discharge_type' => $discharge_type[1],
                'patient_id' => $index,
                'discharge_hospital_id' => $index - 20
            ]);
        }
    }
}
