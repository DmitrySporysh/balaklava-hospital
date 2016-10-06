<?php

use Illuminate\Database\Seeder;

class HospitalDepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 20) as $index) {
            DB::table('hospital_departments')->insert([
                'department_name' => 'отделение №'.$index ,
                'address' => 'г.Севастополь, ул.Гагарина №'.$index,
                'department_chief_id' => 4*(($index % 3)+1)
            ]);
        }
    }
}
