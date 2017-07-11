<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    /**
     * 主界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * 引进Info界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info()
    {
        return view('admin.info');
    }

    /**
     * 修改密码
     */
    public function pwd()
    {
        if ($pwd = Input::all()){
            $rules = [
                'password' => 'required|between:5,20|confirmed',

            ];
            $msg = [
                'password.required'     => '新密码不能为空!',
                'password.between'      => '新密码要在5-20位之间!',
                'password.confirmed'    => '新密码和确认密码不一致!',
            ];

            $validator = Validator::make($pwd,$rules,$msg);
            if ($validator->passes()){
                $user = User::first();
                $_pwd = Crypt::decrypt($user->user_pwd);
                if ($_pwd == $pwd['password_o']){
                    $user->user_pwd = Crypt::encrypt($pwd['password']);
                    $user->update();
                    return redirect('admin/info');
                }else{
                    return back()->withErrors('原密码错误！');
                }
            }else{
                return back()->withErrors($validator);
            }
        }else{
            return view('admin.pwd');
        }
    }
}
