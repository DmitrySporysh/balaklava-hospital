<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDressingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dressings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('dressing_date');
            $table->string('dressing_name');

            $table->integer('patient_id')->unsigned();
            $table->integer('doctor_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('dressings',function (Blueprint $table){
            $table->foreign('patient_id')->references('id')->on('patients')
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
        Schema::drop('dressings');
    }
}
