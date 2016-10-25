<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInpatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inpatients', function (Blueprint $table) {
            $table->increments('id');

            $table->timestamp('start_date');

            $table->string('diagnosis')->nullable();

            $table->integer('received_patient_id')->unsigned();
            $table->integer('district_doctor_id')->unsigned()->nullable();
            $table->integer('attending_doctor_id')->unsigned()->nullable();
            $table->integer('hospital_department_id')->unsigned()->nullable();
            $table->integer('chamber_id')->unsigned()->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('inpatients',function (Blueprint $table){
            $table->foreign('received_patient_id')->references('id')->on('received_patients')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('inpatients');
    }
}

