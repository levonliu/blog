<?php

namespace App\Http\Controllers\Home;

use App\Http\model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        $navs = Navs::all();
        View::share('navs',$navs);
    }
}
