<?php

use Illuminate\Database\Seeder;

class ReceivedPatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $str = File::get('database/seeds/patients.txt');
        $fios = explode("\r\n", $str);

        $received_types = array('плановое', 'эксренное', 'по скорой', 'другое');
        $marital_status = array('в браке', 'не в браке');

        foreach (range(1, 40) as $index) {
            DB::table('received_patients')->insert([
                'fio' => $fios[$index-1],
                'received_date' => '2016-10-'. ($index % 30 + 1),
                'inspection_protocol_id' => $index,
                'patient_id' => $index,
                'registration_nurse_id' => 1 + ((($index - 1) % 4) * 4),
                'phone' => '797800007'.($index % 20 * 10),
                'received_type' => $received_types[$index % 4],

                'marital_status' => $marital_status[$index % 2],
                'work_place' => 'Фирма № '.($index % 8 + 1),
                'residential_address' => 'г.Севастополь, ул.Вакуленчука №'.$index,
                'registration_address' => 'г.Севастополь, ул.Гагарина №'.$index,
                'complaints' => 'у пацинта что-то болит. Говорит "мне прям ваще фигово"',


                'policy_oms' => mt_rand(),
                'education' => 'Высшее образование СевГУ',
                'medical_insurance_company' => 'Страхование РФ',
                'medical_company_sent' => '1 гор больница',
                'diagnosis_medical_company_sent' => 'Разрыв кишки',
                'diagnosis_complications_medical_company_sent' => 'Кровоизлеяние в живот'
            ]);
        }

        foreach (range(41, 300) as $index) {
            DB::table('received_patients')->insert([
                'fio' => $fios[$index - 1],
                'received_date' => '2016-10-10 08:'.($index % 60).':00',
                'patient_id' => $index,
                'phone' => '79781345'.($index * 10),
                'received_type' => $received_types[$index % 4],

                'registration_nurse_id' => 1 + ((($index - 1) % 4) * 4),
                'marital_status' => $marital_status[$index % 2],
                'work_place' => 'Фирма № '.($index % 25 + 1),
                'residential_address' => 'г.Севастополь, ул.Вакуленчука №'.$index,
                'registration_address' => 'г.Севастополь, ул.Гагарина №'.$index,
                'complaints' => 'у пацинта что-то болит. Говорит "мне прям ваще фигово"',

                'policy_oms' => mt_rand(),
                'education' => 'Высшее образование СевГУ',
                'medical_insurance_company' => 'Страхование РФ',
                'medical_company_sent' => '1 гор больница',
                'diagnosis_medical_company_sent' => 'Разрыв кишки',
                'diagnosis_complications_medical_company_sent' => 'Кровоизлеяние в живот'
            ]);
        }
    }
}
