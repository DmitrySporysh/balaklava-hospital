<?php

use Illuminate\Database\Seeder;

class BindingHospitalDepartmentWithDepartmentChiefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*всего 18 отделений*/
        foreach (range(1, 18) as $index) {
            //связывание зав отделения с отделением
            DB::table('hospital_departments')->updateOrInsert(['id' => $index], [
                'department_chief_id' => $index
            ]);
        }
    }
}
