<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('survey_name');
            $table->timestamp('survey_date');
            $table->boolean('status');
            $table->string('result_text')->nullable();
            $table->string('result_file')->nullable();

            $table->integer('patient_id')->unsigned();
            $table->integer('doctor_id')->unsigned();
            $table->integer('survey_type_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('surveys',function (Blueprint $table){
            $table->foreign('patient_id')->references('id')->on('patients')
                ->onUpdate('cascade');
            $table->foreign('doctor_id')->references('id')->on('health_workers')
                ->onUpdate('cascade');
            $table->foreign('survey_type_id')->references('id')->on('surveys_types')
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
        Schema::drop('surveys');
    }
}
