<?php

namespace App\Http\Controllers\Home;

use App\Http\model\Navs;
use Illuminate\Http\Request;
use App\Http\Model\Article;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        #导航栏
        $navs = Navs::all();

        #最新发布文章（8篇）
        $newData = Article::orderBy('art_time','desc')->take(8)->get();

        #点击量最高的(5篇)
        $hotarts = Article::orderBy('art_view','desc')->take(5)->get();

        View::share('navs',$navs);
        View::share('newData',$newData);
        View::share('hotarts',$hotarts);
    }
}
