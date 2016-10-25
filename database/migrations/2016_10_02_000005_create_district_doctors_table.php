<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('district_doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fio');
            $table->string('address');
            $table->date('birth_date');
            $table->string('description')->nullable();

            $table->integer('hospital_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('district_doctors', function (Blueprint $table) {
            $table->foreign('hospital_id')->references('id')->on('hospitals')
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
        Schema::dropIfExists('district_doctors');
    }
}
