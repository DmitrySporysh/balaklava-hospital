<?php

    use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectionsProtocolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections_protocols', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('duty_doctor_id')->unsigned();
            $table->timestamp('date');


            //из анамнеза (истории болезни)
            $table->string('from_anamnesis')->nullable();
            //в анамнезе
            $table->string('in_anamnesis')->nullable();
            // Страховой анамнез
            $table->string('insurance_anamnesis')->nullable();
            // Алерго анамнез
            $table->string('allergoanamnez')->nullable();
            //состояние
            $table->string('condition')->nullable();


            //•	Сознание больного
            $table->string('consciousness')->nullable();
            //•	Телосложение
            $table->string('body_type')->nullable();
            //•	Питание
            $table->string('food')->nullable();
            //•	Кожные покровы
            $table->string('skin')->nullable();

            $table->string('skin_extended')->nullable();
            //•	Тургор
            $table->string('turgor')->nullable();
            //•	Зрачки
            $table->string('pupils')->nullable();
            //•	Язык
            $table->string('tongue')->nullable();
            $table->string('tongue_extended')->nullable();
            //•	Аускультативно над лёгкими дыхание
            $table->string('auscultation')->nullable();

            $table->string('auscultation_extended')->nullable();
            //•	Перкуторно над лёгкими звук
            $table->string('percussion_sound')->nullable();
            //•	Тоны сердца
            $table->string('heart_tones')->nullable();
            //Ритм
            $table->string('heart_rhythm')->nullable();
            $table->string('heart_rhythm_extended')->nullable();
            //•	ЧДД (частота дыхательных движений)
            $table->string('respiratory_movements_frequency_ChDD')->nullable();
            //•	ЧСС (частота сердечных сокращений)
            $table->string('heart_rate_ChSS')->nullable();

            //•	Границы сердца
            $table->string('heart_boundaries')->nullable();
            $table->string('heart_boundaries_extended')->nullable();

            //•	Мышечный тонус
            $table->string('muscle_tone')->nullable();
            $table->string('muscle_tone_extended')->nullable();
            //•	Движение в суставах
            $table->string('joint_motion')->nullable();
            //Плотность живота
            $table->string('stomach_density')->nullable();
            //Болезненность живота
            $table->string('stomach_pain')->nullable();
            $table->string('stomach_extended')->nullable();
            //•	В позе Ромберга
            $table->string('in_romberg_position')->nullable();
            //•	Походка
            $table->string('gait')->nullable();
            $table->string('gait_extended')->nullable();
            //•	Стул
            $table->string('stools')->nullable();
            $table->string('stools_extended')->nullable();
            //•	стул по консистенции
            $table->string('stools_consistency')->nullable();


            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('inspections_protocols', function (Blueprint $table) {
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
        Schema::dropIfExists('inspections_protocols');
    }
}

