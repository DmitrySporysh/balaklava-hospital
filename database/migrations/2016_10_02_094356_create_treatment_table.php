<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('treatment_name');
            $table->string('description')->nullable();
            $table->date('date');

            $table->integer('id_patient')->unsigned();
            $table->integer('id_doctor')->unsigned();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('treatment',function (Blueprint $table){
            $table->foreign('id_patient')->references('id')->on('patients')
                ->onUpdate('cascade');
            $table->foreign('id_doctor')->references('id')->on('medical_staff')
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
        Schema::drop('treatment');
    }
}
