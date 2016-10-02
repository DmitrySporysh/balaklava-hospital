<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDischargeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discharge', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('discharge_date');
            $table->string('result_epicrisis');
            $table->enum('discharge_type', array('discharge', 'transfer', 'death', 'other'));

            $table->integer('id_patient')->unsigned();
            $table->integer('id_discharge_hospital')->unsigned()->nullable();
            $table->integer('id_discharge_department')->unsigned()->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('discharge',function (Blueprint $table){
            $table->foreign('id_patient')->references('id')->on('patients')
                ->onUpdate('cascade');
            $table->foreign('id_discharge_hospital')->references('id')->on('hospitals')
                ->onUpdate('cascade');
            $table->foreign('id_discharge_department')->references('id')->on('hospital_departments')
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
        Schema::drop('discharge');
    }
}
