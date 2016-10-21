<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalyzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('analyzes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('appointment_date');
            $table->timestamp('ready_date');
            $table->string('description');
            $table->string('result_description');

            $table->integer('inpatient_id')->unsigned();
            $table->integer('doctor_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('analyzes',function (Blueprint $table){
            $table->foreign('inpatient_id')->references('id')->on('inpatients')
                ->onUpdate('cascade');
            $table->foreign('doctor_id')->references('id')->on('health_workers')
                ->onUpdate('cascade');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::drop('analyzes');*/
    }
}
