<?php

namespace App\Http\Controllers\Admin;

use App\Http\model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommonController
{
    /**
     * get admin/navs
     * 全部友情列表
     */
    public function index()
    {
        $navsData = Navs::orderBy('nav_order','asc')->paginate(7);
        return view('admin.navs.index',compact('navsData'));
    }

    /**
     * 列表排序
     */
    public function changeorder()
    {
        $input = Input::all();
        $nav = Navs::find($input['nav_id']);
        $nav['nav_order'] = $input['nav_order'];
        $re = $nav->update();
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
        return view('admin.navs.add');
    }

    /**
     * post admin/category
     * 添加链接提交
     */
    public function store()
    {
        $post = Input::except('_token');
        $rules = [
            'nav_name' => 'required',
            'nav_url' => 'required',
        ];
        $msg = [
            'nav_name.required' => '友情链接名称不能为空!',
            'nav_url.required'  => '友情链接不能为空!',
        ];

        $validator = Validator::make($post,$rules,$msg);
        if ($validator->passes()){
            $re = Navs::create($post);
            if ($re){
                return redirect('admin/navs');
            }else{
                return back()->withErrors('添加失败,请稍候在试！');
            }
        }else{
            return back()->withErrors($validator);
        }

    }

    /**
     * get admin/category/{category}/edit
     * 编辑
     */
    public function edit($nav_id)
    {
        $navData = Navs::find($nav_id);
        return view('admin.navs.edit',compact('navData'));
    }

    /**
     * put admin/category/{category}
     * 更新
     */
    public function update($nav_id)
    {
        $updata = Input::except('_token','_method');
        $rules = [
            'nav_name' => 'required',
            'nav_url' => 'required',
        ];
        $msg = [
            'nav_name.required' => '导航名称不能为空!',
            'nav_url.required'  => '导航链接不能为空!',
        ];
        $validator = Validator::make($updata,$rules,$msg);
        if ($validator->passes()){
            $re = Navs::where('nav_id',$nav_id)->update($updata);
            if ($re){
                return redirect('admin/navs');
            }else{
                return back()->withErrors('链接修改失败,请稍后重试！');
            }
        }else{
            return back()->withErrors($validator);
        }
    }


    /**
     * get admin/category/{category}
     * 显示
     */
    public function show()
    {

    }


    /**
     * delete admin/category/{category}
     * 删除
     */
    public function destroy($delId)
    {
        $re = Navs::where('nav_id',$delId)->delete();
        if ($re){
            $data = ['status' => 0, 'msg' => '删除成功！'];
        }else{
            $data = ['status' => 1, 'msg' => '删除失败！,请稍后重试'];
        }
        return $data;
    }
}
