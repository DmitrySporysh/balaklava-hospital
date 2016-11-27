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
            foreach (range(1, count($operation_name)) as $day) {
                DB::table('operations')->insert([
                    'inpatient_id' => $index,
                    'doctor_who_appointed' => 2 + 3 * (($index + $day) % 10) + 17,
                    'doctor_who_performed' =>
                        $day % 3 != 0
                            ? (2 + 3 * (($index + $day + 2) % 10) + 17)
                            : null,

                    'appointment_date' => '2016-10-' . $day,
                    'operation_date' => $day % 3 != 0 ? '2016-10-' . ($day + 4) : null,

                    'operation_name' => $operation_name[$day-1],
                    'preliminary_epicrisis' => 'у пациента что-то болело, это надо удалить/поправить',
                    'operation_description' => 'тут описание операции',
                    'result_description' => $day % 3 != 0 ? 'операция прошла успешно' : null
                ]);
            }
        }
    }
}
