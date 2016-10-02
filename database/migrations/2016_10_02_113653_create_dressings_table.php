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
        Schema::create('dressing', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('dressing_date');
            $table->string('dressing_name');

            $table->integer('id_patient')->unsigned();
            $table->integer('id_doctor')->unsigned();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('dressing',function (Blueprint $table){
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
        Schema::drop('dressing');
    }
}
