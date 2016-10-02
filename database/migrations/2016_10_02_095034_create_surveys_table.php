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
            $table->string('treatment_name');
            $table->string('description')->nullable();
            $table->timestamp('survey_date');
            $table->boolean('status');
            $table->string('result_text')->nullable();
            $table->string('result_file')->nullable();

            $table->integer('id_patient')->unsigned();
            $table->integer('id_doctor')->unsigned();
            $table->integer('id_survey_type')->unsigned();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('surveys',function (Blueprint $table){
            $table->foreign('id_patient')->references('id')->on('patients')
                ->onUpdate('cascade');
            $table->foreign('id_doctor')->references('id')->on('medical_staff')
                ->onUpdate('cascade');
            $table->foreign('id_survey_type')->references('id')->on('surveys_types')
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
