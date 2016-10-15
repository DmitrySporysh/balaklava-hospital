<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectionsProtocolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections_protocol', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('duty_doctor_id')->unsigned();
            $table->timestamp('date');

            //жалобы
            $table->string('complaints ')->nullable();
            //из анамнеза (истории болезни)
            $table->string('from_anamnesis')->nullable();
            //в анамнезе
            $table->string('in_anamnesis')->nullable();
            // Страховой анамнез
            $table->string('insurance_anamnesis')->nullable();
            // Алерго анамнез
            $table->string('allergoanamnez')->nullable();
            //состояние
            $table->enum('condition', array('удовлетворительное', 'ср. тяжести', 'тяжелое', 'другое'))->nullable();
            //•	Сознание больного
            $table->enum('consciousness', array('ясное', 'нарушенное (заторможен)', 'нарушенное (возбужден)', 'ступор', 'сопор',
                'кома', 'без сознания'))->nullable();
            //•	Телосложение
            $table->enum('body_type', array('астеническое', 'нормостеническое', 'гиперстеническое'))->nullable();
            //•	Питание
            $table->enum('food', array('пониженное', 'нормальное', 'повышенное'))->nullable();
            //•	Кожные покровы
            $table->enum('skin', array('нормальной окраски', 'желтушные', 'синюшные (цианоз)',
                'красные (гиперемия)', 'сухие', 'влажные'))->nullable();
            //•	Тургор
            $table->enum('turgor', array('эластичная', 'дряблая'))->nullable();
            //•	Зрачки
            $table->enum('pupils', array('не увеличены', 'расширены', 'сужены', 'не реагируют на свет'))->nullable();
            //•	Язык
            $table->enum('tongue', array('сухой', 'влажный', 'обложен налётом (белым)', 'обложен налётом (желтым)'
            , 'обложен налётом (другим)'))->nullable();
            $table->string('tongue_extended')->nullable();
            //•	Аускультативно над лёгкими дыхание
            $table->enum('auscultation', array('везикулярное (нормальное)', 'выслушиваются сухие хрипы',
                'выслушиваются влажные хрипы (свистящие, жужжащие) (на вдохе, на выдохе)',
                'крепитация', 'шум трения плевры', 'шум трения перикарда', 'посторонние шумы (бронхиальные, органные)'))->nullable();
            $table->string('auscultation_extended')->nullable();
            //•	Перкуторно над лёгкими звук
            $table->enum('percussion_sound', array('легочный (нормальное)', 'тимпанический (тупой)', 'коробочный',
                'с коробочным оттенком'))->nullable();
            //•	Тоны сердца
            $table->enum('heart_tones', array('ясные', 'приглушены', 'глухие', 'не выслушиваются'))->nullable();
            //Ритм сердца
            $table->enum('heart_rhythm', array('правильный (брадикардия, нормокардия, тахикардия)',
                'неправильный (экстрасистолия, мерцательная аритмия)', 'синусовый',
                'несинусовый (узловой, желудочковый)'))->nullable();
            $table->string('heart_rhythm_extended')->nullable();
            //•	ЧДД (частота дыхательных движений)
            $table->string('respiratory_movements_frequency(ChDD)')->nullable();
            //•	ЧСС (частота сердечных сокращений)
            $table->string('heart_rate(ChSS)')->nullable();

            //•	Границы сердца
            $table->enum('heart_boundaries', array('не отклонены', 'отклонены на х см (влево, вправо, вверх, вниз)'))->nullable();
            $table->string('heart_boundaries_extended')->nullable();

            //•	Мышечный тонус
            $table->enum('muscle_tone', array('нормальный', 'снижен (атония)', 'повышен (ригидность)(где?)'))->nullable();
            $table->string('muscle_tone_extended')->nullable();
            //•	Движение в суставах
            $table->enum('joint_motion', array('сохранено', 'ограничено'))->nullable();
            //Плотность живота
            $table->enum('stomach_density', array('мягкий', 'твёрдый'))->nullable();
            //Болезненость живота
            $table->enum('stomach_pain', array('болезненный', 'безболезненный'))->nullable();
            $table->string('stomach_extended')->nullable();
            //•	В позе Ромберга
            $table->enum('in_romberg_position', array('устойчив', 'неустойчив', 'устойчив с шатанием'))->nullable();
            //•	Походка
            $table->enum('gait', array('обычная', 'нарушенная (какая?)'))->nullable();
            $table->string('gait_extended')->nullable();
            //•	Стул
            $table->enum('stools', array('норма', 'учащен (до х раз в сутки)', 'задержка (до х суток)'))->nullable();
            $table->string('stools_extended')->nullable();
            //•	стул по консистенции
            $table->enum('stools_consistency', array('кашицеобразный', 'твердый', 'жидкий'))->nullable();


            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('inspections_protocol', function (Blueprint $table) {
            $table->foreign('duty_doctor_id')->references('id')->on('health_workers')
                ->onUpdate('cascade');
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inspections_protocol');
    }
}

