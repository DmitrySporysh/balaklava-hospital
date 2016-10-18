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
        $condition = array('удовлетворительное', 'ср. тяжести', 'тяжелое', 'другое');

        $consciousness = array('ясное', 'нарушенное (заторможен)', 'нарушенное (возбужден)', 'ступор', 'сопор',
        'кома', 'без сознания');

        $body_type = array('астеническое', 'нормостеническое', 'гиперстеническое');

        $food = array('пониженное', 'нормальное', 'повышенное');

        $skin = array('нормальной окраски', 'желтушные', 'синюшные (цианоз)',
            'красные (гиперемия)', 'сухие', 'влажные');

        $turgor = array('эластичная', 'дряблая');

        $pupils = array('не увеличены', 'расширены', 'сужены', 'не реагируют на свет');

        $tongue = array('сухой', 'влажный', 'обложен налётом (белым)', 'обложен налётом (желтым)'
        , 'обложен налётом (другим)');

        $auscultation = array('везикулярное (нормальное)', 'выслушиваются сухие хрипы',
            'выслушиваются влажные хрипы (свистящие, жужжащие) (на вдохе, на выдохе)',
            'крепитация', 'шум трения плевры', 'шум трения перикарда', 'посторонние шумы (бронхиальные, органные)');

        $percussion_sound = array('легочный (нормальное)', 'тимпанический (тупой)', 'коробочный',
            'с коробочным оттенком');

        $heart_tones = array('ясные', 'приглушены', 'глухие', 'не выслушиваются');

        $heart_rhythm = array('правильный (брадикардия, нормокардия, тахикардия)',
            'неправильный (экстрасистолия, мерцательная аритмия)', 'синусовый',
            'несинусовый (узловой, желудочковый)');

        $heart_boundaries = array('не отклонены', 'отклонены на х см (влево, вправо, вверх, вниз)');

        $muscle_tone = array('легочный (нормальное)', 'тимпанический (тупой)', 'коробочный',
            'с коробочным оттенком');
        
        $joint_motion = array('сохранено', 'ограничено');

        $stomach_density = array('мягкий', 'твёрдый');

        $stomach_pain = array('болезненный', 'безболезненный');

        $in_romberg_position = array('устойчив', 'неустойчив', 'устойчив с шатанием');

        $gait = array('обычная', 'нарушенная (какая?)');

        $stools = array('норма', 'учащен (до х раз в сутки)', 'задержка (до х суток)');

        $stools_consistency = array('кашицеобразный', 'твердый', 'жидкий');

        foreach (range(1, 40) as $index) {
            DB::table('patients')->insert([
                'duty_doctor_id' => 2 + 4 * ($index % 4),
                'date' => '2016-10-'.($index % 30 + 1).' 08:'.($index + 9).':00',
                'complaints' => 'Пациент говорит, что ему плохо где-то в груди',
                'from_anamnesis' => 'тут какой-то текст',
                'in_anamnesis' => 'тут какой-то текст',
                'insurance_anamnesis' => 'тут какой-то текст',
                'allergoanamnez' => 'тут какой-то текст',
                'condition' => $condition[$index % 4],
                'consciousness' => $consciousness [$index % 7],
                'body_type' => $body_type[$index % 3],
                'food' => $food[$index % 3],
                'skin' => $skin[$index % 6],
                'turgor' => $turgor[$index % 2],
                'pupils' => $pupils[$index % 4],
                'tongue' => $tongue[$index % 5],
                'tongue_extended' => '...',
                'auscultation' => $auscultation[$index % 7],
                'percussion_sound' => $percussion_sound[$index % 4],
                'heart_tones' => $heart_tones[$index % 4],
                'heart_rhythm' => $heart_rhythm[$index % 4],
                'respiratory_movements_frequency(ChDD)' => (12 + $index % 4),
                'heart_rate(ChSS)' => (70 + $index % 20),
                'heart_boundaries' => $heart_boundaries[$index % 2],
                'muscle_tone' => $muscle_tone[$index % 3],
                'joint_motion' => $joint_motion[$index % 2],
                'stomach_density' => $stomach_density[$index % 2],
                'stomach_pain' => $stomach_pain[$index % 2],
                'in_romberg_position' => $in_romberg_position[$index % 3],
                'gait' => $gait[$index % 2],
                'stools' => $stools[$index % 3],
                'stools_consistency' => $stools_consistency[$index % 3]
            ]);
        }

    }
}
