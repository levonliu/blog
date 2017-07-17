<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Links;
use Illuminate\Http\Request;
use App\Http\Requests;

class IndexController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    //首页
    public function index()
    {
        #点击量最高的6篇文章
        $hot = Article::orderBy('art_view','desc')->take(6)->get();

        #图文列表
        $artData = Article::orderBy('art_time','desc')->paginate(5);

        #最新发布文章（8篇）
        $newData = Article::orderBy('art_time','desc')->take(8)->get();

        #友情链接
        $links = Links::orderBy('link_order','asc')->get();

        #网站配置项

        return view('home.index',compact('hot','artData','newData','links'));
    }

    //文章列表
    public function cate()
    {
        return view('home.list');
    }

    //文章详情
    public function article()
    {
        return view('home.news');
    }
}
