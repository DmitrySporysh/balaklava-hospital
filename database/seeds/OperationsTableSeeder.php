<?php

use Illuminate\Database\Seeder;

class OperationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operation_name = [
            'Ампутация',
            'Резекция',
            'Стомия',
            'Протезирование',
            'Пластическая операция',
            'Эктомия',
            'Аппендэктомия',
            'Нефрэктомия'
        ];


        foreach (range(1, 20) as $index) {
            foreach (range(1, $index % count($operation_name) + 1) as $day) {
                DB::table('operations')->insert([
                    'inpatient_id' => $index,
                    'doctor_id' => 3 + 3 * (($index + $day) % 10) + 17,

                    'appointment_date' => '2016-10-' . $day,
                    'operation_date' => $day % 3 != 0 ? '2016-10-' . ($day + 4) : null,

                    'operation_name' => $operation_name[$index % count($operation_name)],
                    'preliminary_epicrisis' => 'у пациента что-то болело, это надо было удалить/поправить',
                    'operation_description' => 'тут описание операции',
                    'result' => $day % 2 != 0 ? 'операция прошла успешно' : null
                ]);
            }
        }
    }
}
