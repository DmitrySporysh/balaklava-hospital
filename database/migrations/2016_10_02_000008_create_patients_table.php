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

            $table->integer('district_doctor_id')->unsigned()->nullable();
            $table->integer('attending_doctor_id')->unsigned()->nullable();
            $table->integer('hospital_department_id')->unsigned()->nullable();
            $table->integer('chamber_id')->unsigned()->nullable();
            
            $table->softDeletes();            
            $table->timestamps();
        });

        Schema::table('patients',function (Blueprint $table){
            $table->foreign('district_doctor_id')->references('id')->on('district_doctors')
                ->onUpdate('cascade');
            $table->foreign('attending_doctor_id')->references('id')->on('health_workers')
                ->onUpdate('cascade');
            $table->foreign('hospital_department_id')->references('id')->on('hospital_departments')
                ->onUpdate('cascade');
            $table->foreign('chamber_id')->references('id')->on('chambers')
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
