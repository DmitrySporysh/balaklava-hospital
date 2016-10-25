<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inpatient_id')->unsigned();
            $table->integer('doctor_id')->unsigned();

            $table->timestamp('appointment_date');
            $table->timestamp('operation_date')->nullable();

            $table->string('operation_name');
            $table->string('preliminary_epicrisis');
            $table->string('operation_description')->nullable();
            $table->string('result')->nullable();
            $table->string('paths_to_files')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('operations',function (Blueprint $table){
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
        Schema::dropIfExists('operations');
    }
}
