<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fio');
            $table->enum('sex', array('male', 'female'));
            $table->date('birth_date');
            $table->timestamp('receipt_date');
            $table->string('initial_inspection')->nullable();
            $table->string('preliminary_diagnosis')->nullable();
            $table->string('confirmed_diagnosis')->nullable();

            $table->integer('id_district_doctor')->unsigned()->nullable();
            $table->integer('id_attending_doctor')->unsigned()->nullable();
            $table->integer('id_hospital_department')->unsigned()->nullable();
            $table->integer('id_bed')->unsigned()->nullable();
            
            $table->softDeletes();            
            $table->timestamps();
        });

        Schema::table('patients',function (Blueprint $table){
            $table->foreign('id_district_doctor')->references('id')->on('district_doctors')
                ->onUpdate('cascade');
            $table->foreign('id_attending_doctor')->references('id')->on('medical_staff')
                ->onUpdate('cascade');
            $table->foreign('id_hospital_department')->references('id')->on('hospital_departments')
                ->onUpdate('cascade');
            $table->foreign('id_bed')->references('id')->on('beds')
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
        Schema::drop('patients');
    }
}
