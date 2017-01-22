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
        $str = File::get('database/seeds/departments_cheifs.txt');
        $departments_cheifs_fios = explode("\r\n", $str);
        $str = File::get('database/seeds/med_personal.txt');
        $med_personal_fios = explode("\r\n", $str);


        $post = array(
            'Медсестра', 'Врач'
        );

        /*всего 18 отделений*/
        foreach (range(1, 18) as $index) {
            DB::table('health_workers')->insert([
                'fio' => $departments_cheifs_fios[$index],
                'birth_date' => '19' . (65 + $index) . '-' . ($index % 12 + 1) . '-' . $index,
                'sex' => ($index % 2) ? 'Мужской' : 'Женский',
                'post' => 'Заведующий отделением',
                'login_id' => $index,
                'department_id' => $index
            ]);
        }

        foreach (range(1, 18) as $departmentIndex) {
            foreach (range(1, 8) as $currentIndex) {

                $index = 18 + ($departmentIndex - 1) * 8 + $currentIndex;

                DB::table('health_workers')->insert([
                    'fio' => $med_personal_fios[$index - 19],
                    'sex' => ($index % 2) ? 'Мужской' : 'Женский',
                    'birth_date' => '19' . (65 + $index % 32) . '-' . ($index % 12 + 1) . '-' . $index,
                    'post' => $post[$index % 2],
                    'login_id' => $index,
                    'department_id' => $departmentIndex
                ]);
            }
        }
    }
}
