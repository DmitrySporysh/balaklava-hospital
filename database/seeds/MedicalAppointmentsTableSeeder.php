<?php

use Illuminate\Database\Seeder;

class MedicalAppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $descriptions = [
            'Диета №1 с ограничением жиров и сахарозы',
            'NaCl 0,9% 200ml в/в - капельно',
            'Sol. Enalapryli в/в - капельно - 2 р/день',
            'Sol. Asparcami в/в - капельно - 2р/день',
            'Sol. Euphyllini в/в - капельно  - 2 р/день',
            'Sol. Prednisoloni в/в - капельно - 1 р/день',
            'Tab. Berodual H - 3 р/день',
            'Tab. Analgini - по мере необходимости',
            'Диета №15 с ограничением жидкости и соли',
            'Диета №2 с ограничением жиров и сахарозы',
            'Диета №3 с ограничением жиров и сахарозы'
        ];


        foreach (range(1, 40) as $index) {
            foreach (range(0, count($descriptions) - ($index % 11) -1) as $description) {
                DB::table('medical_appointments')->insert([
                    'description' => $descriptions[$description],
                    'date' => '2016-10-' . ($description + 1),
                    'inpatient_id' => $index,
                    'doctor_id' => 4 * (($index % 3) + 1)
                ]);
            }

        }
    }
}
