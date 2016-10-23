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
        $blood_type = [
            '1+', '1-',
            '2+', '2-',
            '3+', '3-',
            '4+', '4-'
        ];

        foreach (range(1, 300) as $index) {
            DB::table('patients')->insert([
                'sex' => ($index % 2) ? 'male' : 'female',
                'birth_date' => '1990-10-'.($index % 30 + 1),
                'insurance_number' => $index*1000,
                'blood_type' => $blood_type[$index%8]
            ]);
        }
    }
}
