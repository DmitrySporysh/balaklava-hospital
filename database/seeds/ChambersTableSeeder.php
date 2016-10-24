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
        $beds_occupied_count = ['0', '2', '2', '2', '2', '2', '0', '0', '0', '0'];

        foreach (range(1, 4) as $department) {
            foreach (range(1, 10) as $index) {
                DB::table('chambers')->insert([
                    'number' => $index,
                    'hospital_department_id' => $department,
                    'floor' => $index % 4 + 1,
                    'beds_total_count' => 4,
                    'beds_occupied_count' => $beds_occupied_count[$index % 10],

                    'chamber_sex' => $sex[$index % 3]
                ]);
            }
        }

        foreach (range(5, 18) as $department) {
            foreach (range(1, 10) as $index) {
                DB::table('chambers')->insert([
                    'number' => $index,
                    'hospital_department_id' => $department,
                    'floor' => $index % 2,
                    'beds_total_count' => 4,
                    'beds_occupied_count' => 0,
                    'chamber_sex' => $sex[$index % 3]
                ]);
            }
        }

    }
}
