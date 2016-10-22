<?php

use Illuminate\Database\Seeder;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topic = [
            'Сходить к Сидорову',
            'Отчеты',
            'Зайти к зав отделению неврологического отделением',
            'Зайти на сайт medic.ru',
            'Отчеты 25.10',
            'Позвонить Иванову В.В.',
            '23.10 - день рождения медсестры Мариевой А.',
            'не забыть 26.10 про то самое'
        ];

        $text = [
            'в кабине 203',
            'Сделать отчеты по моим пациентам',
            'обсудь повышение',
            'посмотреть новые законы',
            'отчеты за октябрь',
            'поговорить о жизни',
            'придумать подарок',
            ''
        ];

        foreach (range(1, 30) as $index) {
            foreach (range(0, $index % 7 + 1) as $notes_num)
                DB::table('notes')->insert([
                    'health_worker_id' => $index,
                    'date' => '2016-10-' . ($notes_num + 1),
                    'topic' => $topic[$notes_num],
                    'text' => $text[$notes_num]
                ]);
        }
    }
}
