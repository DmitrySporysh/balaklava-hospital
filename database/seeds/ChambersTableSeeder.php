<?php

use Illuminate\Database\Seeder;

class ChambersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sex = array('male', 'female', 'common');

        foreach (range(1, 20) as $department) {
            foreach (range(1, 10) as $index) {
                DB::table('chambers')->insert([
                    'number' => $index,
                    'hospital_department_id' => $department,
                    'floor' => $index % 2,
                    'beds_total_count' =>
                        ($index % 10 == 1) ? 5 :      //это нужно для тестовых данных
                            (($index % 3) ? 2 : 4),
                    'beds_occupied_count' =>
                        ($index % 10 == 1) ? 2 : 0,      //это нужно для тестовых данных
                    'chamber_sex' => $sex[$index % 3]
                ]);
            }
        }
    }
}
