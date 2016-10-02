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
            $table->integer('bed_number')->unsigned();

            $table->integer('id_chamber')->unsigned();
            $table->integer('id_patient')->unsigned()->unique()->nullable();


            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('beds',function (Blueprint $table){
            $table->foreign('id_chamber')->references('id')->on('chambers')
                ->onUpdate('cascade');
            $table->unique(array('id_chamber', 'bed_number'));
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
