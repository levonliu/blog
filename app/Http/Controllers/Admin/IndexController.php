<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends CommonController
{
    //主界面
    public function index()
    {
        return view('admin.index');
    }

    //引进Info界面
    public function info()
    {
        return view('admin.info');
    }
}
