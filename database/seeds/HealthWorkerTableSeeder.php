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
        $departments_cheifs_fios = explode("\r\n", File::get('database/seeds/departments_cheifs.txt'));
        $med_personal_fios = explode("\r\n", File::get('database/seeds/med_personal.txt'));


        $post = array(
            'Медсестра', 'врач', 'Мед персонал'
        );

        $description = [
            'Ответственный, исполнительный',
            'Пунктуальный, справедливый',
            'Дружелюбный, профессиональный',
            'Быстрообучаемый, внимательный',
            'Решительный, амбициозный',
            'Действенный, уверенный',
            'Понимающий, ответсвтенный',
            'Усидчивый, внимательный'
        ];

        foreach (range(1, 18) as $index) {
            DB::table('health_workers')->insert([
                'fio' => $departments_cheifs_fios[$index],
                'address' => 'г.Севастополь, ул.Вакуленчука №' . $index . ', д.' . ($index + 7) . ', кв.' . ($index + 37),
                'birth_date' => '19' . (65 + $index) . '-' . ($index % 12 + 1) . '-' . $index,
                'post' => 'Заведующий отделением',
                'description' => $description[$index % 8]
            ]);
        }

        foreach (range(1, count($med_personal_fios) - 1) as $index) {
            DB::table('health_workers')->insert([
                'fio' => $med_personal_fios[$index],
                'address' => 'г.Севастополь, ул.Вакуленчука №' . $index . ', д.' . ($index + 7) . ', кв.' . ($index + 37),
                'birth_date' => '19' . (65 + $index % 32) . '-' . ($index % 12 + 1) . '-' . $index,
                'post' => $post[$index % 3],
                'description' => $description[$index % 8]
            ]);
        }
    }
}
