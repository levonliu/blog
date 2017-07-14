<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('conf_id')->comment('id');
            $table->string('conf_title')->default('')->comment('//配置项标题');   //string->varchar
            $table->string('conf_name')->default('')->comment('//配置项变量名');   //string->varchar
            $table->text('conf_content')->default('')->comment('//配置项变量内容');   //string->varchar
            $table->string('conf_tips')->default('')->comment('//配置项备注');
            $table->integer('conf_order')->default(0)->comment('//排序');
            $table->string('field_type')->default(0)->comment('//字段类型');
            $table->string('field_value')->default(0)->comment('//类型值');
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
