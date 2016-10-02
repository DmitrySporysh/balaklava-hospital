<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chamber_id')->unsigned();
            $table->integer('patient_id')->unsigned()->unique()->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('beds',function (Blueprint $table){
            $table->foreign('chamber_id')->references('id')->on('chambers')
                ->onUpdate('cascade');
            $table->foreign('patient_id')->references('id')->on('patients')
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
        Schema::drop('beds');
    }
}
