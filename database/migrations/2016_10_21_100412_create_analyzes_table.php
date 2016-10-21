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
        Schema::create('analyzes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inpatient_id')->unsigned();
            $table->integer('doctor_id')->unsigned();
            $table->timestamp('appointment_date');
            $table->timestamp('ready_date');
            $table->boolean('status')->default(0);
            $table->string('analysis_name');
            $table->string('analysis_description')->nullable();
            $table->string('result_description');
            $table->string('paths_to_files')->nullable();


            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('analyzes',function (Blueprint $table){
            $table->foreign('inpatient_id')->references('id')->on('inpatients')
                ->onUpdate('cascade');
            $table->foreign('doctor_id')->references('id')->on('health_workers')
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
        Schema::drop('analyzes');
    }
}