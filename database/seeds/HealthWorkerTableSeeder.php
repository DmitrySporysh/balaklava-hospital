<?php

use Illuminate\Database\Seeder;

class HealthWorkerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fio = array(
            'Иванов Иван Иванович', 'Петров Петр Петрович', 'Сидоров Иван Петрович'
            , 'Иванова Анна Ивановна', 'Петрова Анна Петровна', 'Сидорова Анна Павловна'
            , 'Сидорова Юлия Николаевна', 'Попова Юлия Николаевна', 'Петрова Екатерина Андреевна'
            , 'Кащук Павел Иванович', 'Закипелов Дмитрий Иванович', 'Попов Дмитрий Николаевич'
            , 'Староверов Павел Иванович', 'Староверов Анна Николаевна', 'Сидорова Юлий Павловна',
            'Карпов Петр Петрович'
        );

        $post = array(
            'chief medical officer', 'nurse', 'attending doctor', 'other'
        );

        foreach (range(1, 15) as $index) {
            DB::table('health_workers')->insert([
                'fio' => $fio[$index],
                'address' => 'г.Севастополь, ул.Вакуленчука №'.$index,
                'birth_date' => '1990-10-10',
                'post' => $post[$index % 4],
                'description' => 'good worker'
            ]);
        }
    }
}
