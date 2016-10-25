<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospital_departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('department_name');
            $table->string('address');

            $table->integer('department_chief_id')->unsigned();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('hospital_departments',function (Blueprint $table){
            $table->foreign('department_chief_id')->references('id')->on('health_workers')
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
        Schema::dropIfExists('hospital_departments');
    }
}
