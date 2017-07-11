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

    public function tree()
    {
        $categorys = $this->all();
        $data      = $this->getTree($categorys,'cate_name','cate_id','cate_pid',0);
        return $data;
    }

    public function getTree($data,$field_name,$field_id='id',$field_pid='pid',$pid=0)
    {
        $arr = array();
        foreach ($data as $k => &$v){
            if ($v[$field_pid] == $pid){
                $v['_'.$field_name] = $v[$field_name];
                $arr[] = $v;
                foreach ($data as $m => &$n){
                    if ($n[$field_pid] == $v[$field_id]){
                        $n['_'.$field_name] = '|—'.$n[$field_name];
                        $arr[] = $n;
                    }
                }
            }
        }
        return $arr;
    }
}
