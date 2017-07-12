<?php
/**
 * 文章控制器
 */
namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticleController extends CommonController
{
    /**
     * get admin/article
     * 全部文章列表
     */
    public function index()
    {
        
    }

    /**
     * get admin/article/create
     * 添加分类
     */
    public function create()
    {
        $data = (new Category())->tree();
        return view('admin.article.add',compact('data'));
    }
}
