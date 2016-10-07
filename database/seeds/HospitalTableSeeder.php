<?php

use Illuminate\Database\Seeder;

class HospitalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 20) as $index) {
            DB::table('hospitals')->insert([
                'hospital_name' => 'Больница им."Иванова И.И." №' . $index,
                'address' => 'Россия, г.Севастополь, ул.Вакуленчука, д.' . ($index+7),
            ]);
        }
    }
}
