<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
    /**
     * get admin/links
     * 全部友情列表
     */
    public function index()
    {
        $linksData = Links::orderBy('link_order','asc')->paginate(7);
        return view('admin.links.index',compact('linksData'));
    }

    /**
     * 列表排序
     */
    public function changeorder()
    {
        $input = Input::all();
        $link = Links::find($input['link_id']);
        $link['link_order'] = $input['link_order'];
        $re = $link->update();
        if ($re){
            $data = ['status' => 0, 'msg' => '分类排序成功！'];
        }else{
            $data = ['status' => 1, 'msg' => '分类排序失败！,请稍后重试'];
        }
        return $data;
    }

    /**
     * get admin/category/create
     * 添加链接
     */
    public function create()
    {
        return view('admin.links.add');
    }

    /**
     * post admin/category
     * 添加链接提交
     */
    public function store()
    {
        $post = Input::except('_token');
        $rules = [
            'link_name' => 'required',
        ];
        $msg = [
            'link_name.required' => '链接名称不能为空!',
        ];

        $validator = Validator::make($post,$rules,$msg);
        if ($validator->passes()){
            $re = Links::create($post);
            if ($re){
                return redirect('admin/links');
            }else{
                return back()->withErrors('添加失败,请稍候在试！');
            }
        }else{
            return back()->withErrors($validator);
        }

    }

    /**
     * get admin/category/{category}/edit
     * 编辑分类
     */
    public function edit($link_id)
    {
        $linkData = Links::find($link_id);
        return view('admin.links.edit',compact('linkData'));
    }

    /**
     * put admin/category/{category}
     * 更新分类
     */
    public function update($cate_id)
    {
        $updata = Input::except('_token','_method');
        $re = Category::where('cate_id',$cate_id)->update($updata);
        if ($re){
            return redirect('admin/category');
        }else{
            return back()->withErrors('分类信息修改失败,请稍后重试！');
        }
    }


    /**
     * get admin/category/{category}
     * 显示单个分类信息
     */
    public function show()
    {

    }


    /**
     * delete admin/category/{category}
     * 删除单个分类
     */
    public function destroy($delId)
    {
        $re = Links::where('link_id',$delId)->delete();
        if ($re){
            $data = ['status' => 0, 'msg' => '删除成功！'];
        }else{
            $data = ['status' => 1, 'msg' => '删除失败！,请稍后重试'];
        }
        return $data;
    }
}
