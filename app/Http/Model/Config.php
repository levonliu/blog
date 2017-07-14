<?php

namespace App\Http\model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    //表名
    protected $table = 'config';

    //主键
    protected $primaryKey = 'conf_id';

    //默认时间设置
    public $timestamps = false;

    //排除不可编辑字段
    protected $guarded = [];
}
