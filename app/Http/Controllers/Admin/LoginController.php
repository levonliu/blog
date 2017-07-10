<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    //登录界面
    public function login()
    {
        if ($input = Input::all()){ //获取表单全部提交的数据
            $code = new \Code();
            $_code = $code->get();
            if (strtoupper($input['code']) != $_code){
                return back()->with('msg','验证码错误');
            }
        }else{
            return view('admin.login');
        }
    }

    //生成验证码
    public function code()
    {
        $code = new \Code();
        $code->make();
    }

    //密码加密
    public function crypt()
    {
        $str = '123456';
        echo Crypt::encrypt($str);
//        echo $str;
    }

}