<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //表名
    protected $table = 'user';

    //主键
    protected $primaryKey = 'user_id';

    //默认时间设置
    public $timestamps = false;
}
