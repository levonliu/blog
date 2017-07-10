<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

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
            dd($pwd);
        }else{
            return view('admin.pwd');
        }
    }
}
