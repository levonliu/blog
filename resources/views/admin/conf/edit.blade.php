@extends('layouts.admin')
@section('content')
    <!--面包屑配置项 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 配置项管理
    </div>
    <!--面包屑配置项 结束-->

    <!--结果集标题与配置项组件 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>修改配置项</h3>
            @if(count($errors))
                <div class="mark">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/conf/create')}}"><i class="fa fa-plus"></i>新增配置项</a>
                <a href="{{url('admin/conf')}}"><i class="fa fa-refresh"></i>全部配置项</a>
            </div>
        </div>
    </div>
    <!--结果集标题与配置项组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/conf/'.$confData['conf_id'])}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>标题：</th>
                    <td>
                        <input type="text" name="conf_title" value="{{$confData['conf_title']}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>配置项标题必须填写!</span>
                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>名称：</th>
                    <td>
                        <input type="text" name="conf_name" value="{{$confData['conf_name']}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>配置项名称必须填写!</span>
                    </td>
                </tr>
                <tr>
                    <th>类型：</th>
                    <td>
                        <input type="radio" name="field_type" value="input" @if($confData['field_type'] == 'input') checked @endif onclick="showValue(this)">input　
                        <input type="radio" name="field_type" value="textarea" @if($confData['field_type'] == 'textarea') checked @endif onclick="showValue(this)">textarea　
                        <input type="radio" name="field_type" value="radio" @if($confData['field_type'] == 'radio') checked @endif onclick="showValue(this)">radio　
                        <span><i class="fa fa-exclamation-circle yellow"></i>类型：input textarea radio</span>
                    </td>
                </tr>
                <tr class="field_value">
                    <th>类型值：</th>
                    <td>
                        <input type="text" class="lg" name="field_value" value="{{$confData['field_value']}}">
                        <p><i class="fa fa-exclamation-circle yellow"></i>类型值只有在radio的情况下才需要配置,格式：1|开启,0|关闭</p>
                    </td>
                </tr>
                <tr>
                    <th>排序：</th>
                    <td>
                        <input type="text" class="sm" name="conf_order" value="{{$confData['conf_order']}}">
                    </td>
                </tr>
                <tr>
                    <th>说明：</th>
                    <td>
                        <textarea name="conf_tips" id="" cols="30" rows="10">{{$confData['conf_tips']}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script>
        showValue();
        function showValue() {
            var type = $('input[type=radio]:checked').val();
            if (type == 'radio'){
                $('.field_value').show();
            }else {
                $('.field_value').hide();
            }
        }
    </script>

@endsection
