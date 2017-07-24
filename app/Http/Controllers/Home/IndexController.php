<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Config;

class IndexController extends CommonController
{
    public function __construct()
    {
        parent::__construct();
    }

    //首页
    public function index()
    {
        #点击量最高的6篇文章(站长推荐)
        $hot = Article::orderBy('art_view','desc')->take(6)->get();

        #图文列表
        $artData = Article::orderBy('art_time','desc')->paginate(5);

        #友情链接
        $links = Links::orderBy('link_order','asc')->get();

        return view('home.index',compact('hot','artData','links'));
    }

    //文章列表
    public function cate($cate_id)
    {
        $art_list = Category::find($cate_id);

        //查看次数自增
        Category::where('cate_id',$cate_id)->increment('cate_view');

        #图文列表(4篇)
        $artData = Article::where('cate_id',$cate_id)->orderBy('art_time','desc')->paginate(4);

        //当前分类的子分类
        $submenu = Category::where('cate_pid',$cate_id)->get();


        return view('home.list',compact('art_list','artData','submenu'));
    }

    //文章详情
    public function article($art_id)
    {
        $art = Article::Join('category','article.cate_id','=','category.cate_id')->where('art_id',$art_id)->first();

        //查看次数自增
        Article::where('art_id',$art_id)->increment('art_view');

        #上一篇文章
        $artPre = Article::where('art_id','<',$art_id)->orderBy('art_id','desc')->first();

        #下一篇文章
        $artNext = Article::where('art_id','>',$art_id)->orderBy('art_id','asc')->first();

        #相关文章
        $artRelate = Article::where('cate_id',$art['cate_id'])->orderBy('art_id','desc')->take(6)->get();

        return view('home.news',compact('art','artPre','artNext','artRelate'));
    }
}
