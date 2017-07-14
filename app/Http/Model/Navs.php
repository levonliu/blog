<?php

namespace App\Http\model;

use Illuminate\Database\Eloquent\Model;

class Navs extends Model
{
    //表名
    protected $table = 'navs';

    //主键
    protected $primaryKey = 'nav_id';

    //默认时间设置
    public $timestamps = false;

    //排除不可编辑字段
    protected $guarded = [];
}
