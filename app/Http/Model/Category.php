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

    //排除不可编辑字段
    protected $guarded = [];

    /**
     * 获取树形结构列表
     * @return array
     */
    public function tree()
    {
        $categorys = $this->orderBy('cate_order','asc')->get();
        $data      = $this->getTree($categorys,'cate_name','cate_id','cate_pid',0);
        return $data;
    }

    /**
     * 重组数据为树形结构
     * @param $data
     * @param $field_name
     * @param string $field_id
     * @param string $field_pid
     * @param int $pid
     * @return array
     */
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
