<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
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
                return back()->with('msg','验证码错误！');
            }
            $user  = User::first();
            if ($user->user_name != $input['user_name'] || Crypt::decrypt($user->user_pwd) != $input['user_pwd']){
                return back()->with('msg','用户名或密码错误！');
            }
            session(['user'=>$user]);
            return redirect('admin/index');
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
        $str = 'admin';
        $str2 = '';
//        echo Crypt::encrypt($str);
//        echo Crypt::decrypt($str2);
    }

    //退出
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }

}