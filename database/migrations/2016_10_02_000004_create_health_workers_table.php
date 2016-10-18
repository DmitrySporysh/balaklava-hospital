<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_workers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fio');
            $table->integer('login_id')->unsigned()->nullable();
            $table->string('address');
            $table->date('birth_date');

            $table->enum('post', array('chief medical officer', 'nurse', 'attending doctor', 'other'))->nullable();
            $table->string('description')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });


        Schema::table('health_workers',function (Blueprint $table){
            $table->foreign('login_id')->references('id')->on('users')
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
        Schema::drop('health_workers');
    }
}
