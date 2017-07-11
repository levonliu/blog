<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends CommonController
{
    /**
     * get admin/category
     * 全部分类列表
     */
    public function index()
    {
        $categorys = (new Category())->tree();
        return view('admin.category.index')->with('data',$categorys);
    }

    /**
     * 列表排序
     */
    public function changeorder()
    {
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate['cate_order'] = $input['cate_order'];
        $re = $cate->update();
        if ($re){
            $data = ['status' => 0, 'msg' => '分类排序成功！'];
        }else{
            $data = ['status' => 1, 'msg' => '分类排序失败！,请稍后重试'];
        }
        return $data;
    }

    /**
     * get admin/category/create
     * 添加分类
     */
    public function create()
    {
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.add',compact('data'));
    }

    /**
     * post admin/category
     * 添加分类提交
     */
    public function store()
    {
        $post = Input::except('_token');

        $rules = [
            'cate_name' => 'required',
        ];
        $msg = [
            'cate_name.required' => '分类名称不能为空!',
        ];

        $validator = Validator::make($post,$rules,$msg);
        if ($validator->passes()){
            $re = Category::create($post);
            if ($re){
                return redirect('admin/category');
            }else{
                return back()->withErrors('添加失败,请稍候在试！');
            }
        }else{
            return back()->withErrors($validator);
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
     * put admin/category/{category}
     * 更新分类
     */
    public function update()
    {

    }

    /**
     * delete admin/category/{category}
     * 删除单个分类
     */
    public function destroy()
    {

    }

    /**
     * get admin/category/{category}/edit
     * 编辑分类
     */
    public function edit()
    {

    }
}
