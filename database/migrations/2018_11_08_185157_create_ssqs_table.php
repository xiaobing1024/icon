<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSsqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ssqs', function (Blueprint $table) {
            $table->increments('id');
            $table->date('day')->unique();
            $table->string('no', 10)->unique();
            $table->unsignedTinyInteger('red1')->index();
            $table->unsignedTinyInteger('red2')->index();
            $table->unsignedTinyInteger('red3')->index();
            $table->unsignedTinyInteger('red4')->index();
            $table->unsignedTinyInteger('red5')->index();
            $table->unsignedTinyInteger('red6')->index();
            $table->unsignedTinyInteger('blue')->index();
            $table->string('number', 15)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ssqs');
    }
}
