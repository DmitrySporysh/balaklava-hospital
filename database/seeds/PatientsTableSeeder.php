<?php

use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 40) as $index) {
            DB::table('patients')->insert([
                'sex' => ($index < 21) ? 'male' : 'female',
                'birth_date' => '1990-10-'.($index % 30 + 1),
                'insurance_number' => $index*1000
            ]);
        }
    }
}
