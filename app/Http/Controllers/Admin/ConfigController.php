<?php

namespace App\Http\Controllers\Admin;

use App\Http\model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommonController
{
    /**
     * get admin/confs
     * 全部友情列表
     */
    public function index()
    {
        $confData = Config::orderBy('conf_order','asc')->paginate(7);

        foreach ($confData as $k => &$v){
            switch ($v['field_type']){
                case 'input':
                    $v['_html'] = '<input type="text" class="lg" name="conf_content['.$v['conf_id'].']" value="'.$v['conf_content'].'">';
                    break;
                case 'textarea':
                    $v['_html'] = '<textarea name="conf_content['.$v['conf_id'].']" id="" cols="30" rows="10">'.$v['conf_content'].'</textarea>';
                    break;
                case 'radio':
                    $radio = explode(',',$v['field_value']);
                    $str = '';
                    foreach ($radio as $m => $n){
                        $r = explode('|',$n);
                        $ck = $v['conf_content'] == $r[0] ? ' checked ': '';
                        $str .= '<input type="radio"'.$ck.' name="conf_content['.$v['conf_id'].']" value="'.$r[0].'" >'.$r[1].' ';
                    }
                    $v['_html'] = $str;
                    break;
            }
        }
        return view('admin.conf.index',compact('confData'));
    }

    /**
     * 修改配置项内容
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changecontent()
    {
        $data = Input::except('_token');
        foreach ($data['conf_content'] as $k => $v){
            Config::where('conf_id',$k)->update(['conf_content'=>$v]);
        }
        //写入到配置文件中
        $this->putFile();
        return back()->withErrors('配置项修改成功!');
    }

    /**
     * 将配置项写入web_conf.php配置文件中
     */
    public function putFile()
    {
        $config = Config::pluck('conf_content','conf_name')->all();
        $path = base_path().'\config\web_conf.php';
        $str = "<?php return ".var_export($config,true).';';
        file_put_contents($path,$str);
    }
    

    /**
     * 列表排序
     */
    public function changeorder()
    {
        $input = Input::all();
        $conf = Config::find($input['conf_id']);
        $conf['conf_order'] = $input['conf_order'];
        $re = $conf->update();
        if ($re){
            $data = ['status' => 0, 'msg' => '配置项排序成功！'];
        }else{
            $data = ['status' => 1, 'msg' => '配置项排序失败！,请稍后重试'];
        }
        return $data;
    }

    /**
     * get admin/category/create
     * 添加链接
     */
    public function create()
    {
        return view('admin.conf.add');
    }

    /**
     * post admin/category
     * 添加链接提交
     */
    public function store()
    {
        $post = Input::except('_token');
        $rules = [
            'conf_name' => 'required',
            'conf_title' => 'required',
        ];
        $msg = [
            'conf_name.required'    => '配置名称不能为空!',
            'conf_title.required'   => '配置标题不能为空!',
        ];

        $validator = Validator::make($post,$rules,$msg);
        if ($validator->passes()){
            $re = Config::create($post);
            if ($re){
                return redirect('admin/conf');
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
    public function edit($conf_id)
    {
        $confData = Config::find($conf_id);
        return view('admin.conf.edit',compact('confData'));
    }

    /**
     * put admin/category/{category}
     * 更新
     */
    public function update($conf_id)
    {
        $updata = Input::except('_token','_method');
        $rules = [
            'conf_name' => 'required',
            'conf_title' => 'required',
        ];
        $msg = [
            'conf_name.required'    => '配置名称不能为空!',
            'conf_title.required'   => '配置标题不能为空!',
        ];
        $validator = Validator::make($updata,$rules,$msg);
        if ($validator->passes()){
            $re = Config::where('conf_id',$conf_id)->update($updata);
            if ($re){
                $this->putFile();
                return redirect('admin/conf');
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
        $re = Config::where('conf_id',$delId)->delete();
        if ($re){
            $this->putFile();
            $data = ['status' => 0, 'msg' => '删除成功！'];
        }else{
            $data = ['status' => 1, 'msg' => '删除失败！,请稍后重试'];
        }
        return $data;
    }
}
