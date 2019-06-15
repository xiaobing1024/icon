<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->comment = '分类表';
            $table->string('name', 50)->default('')->comment('分类名');
            $table->string('icon', 50)->default('')->comment('图标');
            $table->unsignedSmallInteger('pid')->default(0)->comment('父id');
            $table->unsignedTinyInteger('order')->default(0)->comment('排序id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
