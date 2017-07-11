<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //表名
    protected $table = 'category';

    //主键
    protected $primaryKey = 'cate_id';

    //默认时间设置
    public $timestamps = false;
}
