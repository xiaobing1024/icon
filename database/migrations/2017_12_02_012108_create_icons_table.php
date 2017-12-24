<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icons', function (Blueprint $table) {
            $table->increments('id');
            $table->comment = '图标表';
            $table->string('name', 50)->default('')->comment('文件名');
            $table->unsignedTinyInteger('type')->default(0)->comment('所属类型');
            $table->unsignedSmallInteger('width')->default(0)->comment('宽');
            $table->unsignedSmallInteger('height')->default(0)->comment('高');
            $table->unsignedSmallInteger('radius')->default(0)->comment('圆角');
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
        Schema::dropIfExists('icons');
    }
}
