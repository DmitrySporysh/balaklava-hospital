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
                'hospital_name' => 'The best hospital of the world №' . $index,
                'address' => 'Russia, Sevastopol, str. Vakulenchuka ' . ($index+7),
            ]);
        }
    }
}
