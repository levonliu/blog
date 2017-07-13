<?php
/**
 * 文章控制器
 */
namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    /**
     * get admin/article
     * 全部文章列表
     */
    public function index()
    {
        $artData = Article::orderBy('art_id','desc')->paginate(7);
        return view('admin.article.index',compact('artData'));
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

    /**
     * post admin/article
     * 添加文章提交
     */
    public function store()
    {
        $artData = Input::except('_token');
        $artData['art_time'] = time();  //文章发布时间

        $rules = [
            'art_title'     => 'required',
            'art_content'   => 'required',
        ];
        $msg = [
            'art_title.required'    => '文章标题不能为空!',
            'art_content.required'  => '文章内容不能为空!',
        ];
        $validator = Validator::make($artData,$rules,$msg);
        if ($validator->passes()){
            $re = Article::create($artData);
            if ($re){
                return redirect('admin/article');
            }else{
                return back()->withErrors('文章新增失败,请稍候重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * get admin/article/{article}/edit
     * 编辑文章
     */
    public function edit($art_id)
    {
        $artfield = Article::find($art_id);
        $data = (new Category())->tree();
        return view('admin.article.edit',compact('artfield','data'));
    }

    /**
     * put admin/article/{article}
     * 更新文章
     */
    public function update($art_id)
    {
        $updata = Input::except('_token','_method');
        $re = Article::where('art_id',$art_id)->update($updata);
        if ($re){
            return redirect('admin/article');
        }else{
            return back()->withErrors('文章修改失败,请稍后重试！');
        }
    }


    /**
     * delete admin/article/{article}
     * 删除单个分类
     */
    public function destroy($delId)
    {
        $re = Article::where('art_id',$delId)->delete();
        if ($re){
            $data = ['status' => 0, 'msg' => '删除成功！'];
        }else{
            $data = ['status' => 1, 'msg' => '删除失败！,请稍后重试'];
        }
        return $data;
    }
}
