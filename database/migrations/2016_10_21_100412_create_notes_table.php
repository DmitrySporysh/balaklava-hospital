<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('health_worker_id')->unsigned();
            $table->timestamp('date');
            $table->string('topic')->nullable();
            $table->string('text')->nullable();
            //$table->string('image_path')->nullable();


            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('notes',function (Blueprint $table){
            $table->foreign('health_worker_id')->references('id')->on('health_workers')
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
        Schema::dropIfExists('notes');
    }
}
