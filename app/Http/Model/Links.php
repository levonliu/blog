<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    //表名
    protected $table = 'links';

    //主键
    protected $primaryKey = 'link_id';

    //默认时间设置
    public $timestamps = false;

    //排除不可编辑字段
    protected $guarded = [];
}
