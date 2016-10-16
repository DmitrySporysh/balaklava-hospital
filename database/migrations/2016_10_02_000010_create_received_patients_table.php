<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceivedPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_patients', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('patient_id')->unsigned();
            $table->integer('registration_nurse_id')->unsigned();
            $table->timestamp('received_date');

            $table->string('fio');
            $table->string('work_place');
            $table->string('residential_address');
            $table->string('registration_address');
            $table->string('phone')->nullable();
            $table->string('complaints')->nullable();
            $table->enum('received_type', array('плановое', 'эксренное', 'по скорой', 'другое'));

            $table->integer('inspection_protocol_id')->unsigned()->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('received_patients',function (Blueprint $table){
            $table->foreign('patient_id')->references('id')->on('patients')
                ->onUpdate('cascade');
            $table->foreign('registration_nurse_id')->references('id')->on('health_workers')
                ->onUpdate('cascade');
            $table->foreign('inspection_protocol_id')->references('id')->on('inspections_protocols')
                ->onUpdate('cascade');

            $table->unique(array('patient_id', 'received_date'));
        });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('received_patients');
    }
}

