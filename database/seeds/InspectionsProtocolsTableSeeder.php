InpatientsTableSeeder.php<?php

use Illuminate\Database\Seeder;

class InspectionsProtocolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $condition = array('Удовлетворительное', 'Средней тяжести', 'Тяжелое');

        $consciousness = array('Ясное', 'Нарушенное (заторможен)', 'Нарушенное (возбужден)', 'Ступор', 'Сопор',
        'Кома', 'Без сознания');

        $body_type = array('Астеническое', 'Нормостеническое', 'Гиперстеническое');

        $food = array('Пониженное', 'Нормальное', 'Повышенное');

        $skin = array('Нормальной окраски', 'Желтушные', 'Синюшные',
            'Красные', 'Сухие', 'Влажные');

        $turgor = array('Эластичная', 'Дряблая');

        $pupils = array('Не увеличены', 'Расширены', 'Сужены', 'Не реагируют на свет');

        $tongue = array('Сухой', 'Влажный', 'Обложен налётом');

        $auscultation = array('Везикулярное', 'Выслушиваются сухие хрипы',
            'Выслушиваются влажные хрипы', 'Крепитация', 'Шум трения плевры',
            'Шум трения перикарда', 'Посторонние шумы');

        $percussion_sound = array('Легочный', 'Тимпанический', 'Коробочный',
            'С коробочным оттенком');

        $heart_tones = array('Ясные', 'Приглушены', 'Глухие', 'Не выслушиваются');

        $heart_rhythm = array('Правильный',
            'Неправильный', 'Синусовый',
            'Несинусовый');

        $heart_boundaries = array('Не отклонены',
            'Отклонены на х см');

        $muscle_tone = array('Нормальный', 'Снижен', 'Повышен');
        
        $joint_motion = array('Сохранено', 'Ограничено');

        $stomach_density = array('Мягкий', 'Твёрдый');

        $stomach_pain = array('Болезненный', 'Безболезненный');

        $in_romberg_position = array('Устойчив', 'Неустойчив', 'Устойчив с шатанием');

        $gait = array('Обычная', 'Нарушенная');

        $stools = array('Норма', 'Учащен', 'Задержка');

        $stools_consistency = array('Кашицеобразный', 'Твердый', 'Жидкий');

        foreach (range(1, 40) as $index) {
            DB::table('inspections_protocols')->insert([
                'duty_doctor_id' => 2 + 4 * ($index % 4),
                'date' => '2016-10-'.($index % 30 + 1).' 08:'.($index + 9).':00',
                'from_anamnesis' => 'тут какой-то текст',
                'in_anamnesis' => 'тут какой-то текст',
                'insurance_anamnesis' => 'тут какой-то текст',
                'allergoanamnez' => 'тут какой-то текст',
                'condition' => $condition[$index % count($condition)],
                'consciousness' => $consciousness [$index % count($consciousness)],
                'body_type' => $body_type[$index % count($body_type)],
                'food' => $food[$index % count($food)],
                'skin' => $skin[$index % count($skin)],
                'turgor' => $turgor[$index % count($turgor)],
                'pupils' => $pupils[$index %count($pupils)],
                'tongue' => $tongue[$index % count($tongue)],
                'tongue_extended' => '...',
                'auscultation' => $auscultation[$index % count($auscultation)],
                'percussion_sound' => $percussion_sound[$index % count($percussion_sound)],
                'heart_tones' => $heart_tones[$index % count($heart_tones)],
                'heart_rhythm' => $heart_rhythm[$index % count($heart_rhythm)],
                'respiratory_movements_frequency_ChDD' => (12 + $index % 4),
                'heart_rate_ChSS' => (70 + $index % 20),
                'heart_boundaries' => $heart_boundaries[$index % count($heart_boundaries)],
                'muscle_tone' => $muscle_tone[$index % count($muscle_tone)],
                'joint_motion' => $joint_motion[$index % count($joint_motion)],
                'stomach_density' => $stomach_density[$index % count($stomach_density)],
                'stomach_pain' => $stomach_pain[$index % count($stomach_pain)],
                'in_romberg_position' => $in_romberg_position[$index % count($in_romberg_position)],
                'gait' => $gait[$index % count($gait)],
                'stools' => $stools[$index % count($stools)],
                'stools_consistency' => $stools_consistency[$index % count($stools_consistency)],
            ]);
        }

    }
}
