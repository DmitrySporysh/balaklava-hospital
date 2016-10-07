<?php

use Illuminate\Database\Seeder;

class DressingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 5) as $day)
            foreach (range(1, 40) as $index) {
                DB::table('dressings')->insert([
                    'dressing_date' => '2016-10-'.$day,
                    'dressing_name' => 'перевязка пациента  ',
                    'patient_id' => $index,
                    'doctor_id' => 1 + ((($index - 1) % 4) * 4)
                ]);
            }
    }
}
