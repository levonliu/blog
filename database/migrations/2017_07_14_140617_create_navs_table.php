<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navs', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('nav_id')->comment('id');
            $table->string('nav_name')->default('')->comment('//名称');   //string->varchar
            $table->string('nav_alias')->default('')->comment('//别名');
            $table->string('nav_url')->default('')->comment('//url地址');
            $table->integer('nav_order')->default(0)->comment('//排序');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
