<?php
/**
 * 文章模型
 */
namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //表名
    protected $table = 'article';

    //主键
    protected $primaryKey = 'art_id';

    //默认时间设置
    public $timestamps = false;

    //排除不可编辑字段
    protected $guarded = [];
}
