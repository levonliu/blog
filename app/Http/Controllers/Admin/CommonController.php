<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    /**
     * 图片上传
     */
    public function upload()
    {
        $file = Input::file('Filedata');
        //判断文件上传是否有效
        if ($file -> isvalid()){
            $entension  = $file->getClientOriginalExtension();                                  //上传文件的后缀
            $fileName   = date('His').mt_rand(100,999).'.'.$entension;                  //重新生成文件名
            $path       = $file->move(base_path().'/uploads/'.date('Ymd'),$fileName);   //移动文件并重命名
            $filepath   = '/uploads/'.date('Ymd').'/'.$fileName;
            return $filepath;
        }
    }
}
