@extends('layouts.admin')
@section('content')
    <style>
        .result_content ul li span {
            font-size: 15px;
            padding: 6px 12px;
        }
    </style>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 配置项管理
    </div>
    <!--面包屑导航 结束-->

    <!--结果页快捷搜索框 开始-->
    {{--<div class="search_wrap">--}}
        {{--<form action="" method="post">--}}
            {{--<table class="search_tab">--}}
                {{--<tr>--}}
                    {{--<th width="120">选择分类:</th>--}}
                    {{--<td>--}}
                        {{--<select onchange="javascript:location.href=this.value;">--}}
                            {{--<option value="">全部</option>--}}
                            {{--<option value="http://www.baidu.com">百度</option>--}}
                            {{--<option value="http://www.sina.com">新浪</option>--}}
                        {{--</select>--}}
                    {{--</td>--}}
                    {{--<th width="70">关键字:</th>--}}
                    {{--<td><input type="text" name="keywords" placeholder="关键字"></td>--}}
                    {{--<td><input type="submit" name="sub" value="查询"></td>--}}
                {{--</tr>--}}
            {{--</table>--}}
        {{--</form>--}}
    {{--</div>--}}
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <div class="result_wrap">
        <div class="result_title">
            <h3>配置项列表</h3>
            @if(count($errors))
                <div class="mark">
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif
        </div>
        <!--快捷导航 开始-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/conf/create')}}"><i class="fa fa-plus"></i>新增配置项</a>
                <a href="{{url('admin/conf')}}"><i class="fa fa-refresh"></i>更新配置项</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <form action="{{url('admin/conf/changecontent')}}" method="post">
                {{csrf_field()}}
                <table class="list_tab">
                    <tr>
                        <th class="tc" width="5%">排序</th>
                        <th class="tc" width="5%">ID</th>
                        <th>标题</th>
                        <th>配置项名称</th>
                        <th>配置内容</th>
                        <th>操作</th>
                    </tr>
                    @foreach($confData as $v)
                        <tr>
                            <td class="tc">
                                <input type="text" onchange="changeOrder(this,'{{$v['conf_id']}}')" value="{{$v['conf_order']}}">
                            </td>
                            <td class="tc">{{$v['conf_id']}}</td>
                            <td>
                                <a href="#">{{$v['conf_title']}}</a>
                            </td>
                            <td>{{$v['conf_name']}}</td>
                            <td>{!! $v['_html'] !!}</td>
                            <td>
                                <a href="{{url('admin/conf/'.$v['conf_id'].'/edit')}}">修改</a>
                                <a href="javascript:;" onclick="delnav({{$v['conf_id']}})">删除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="page_list">
                    {{$confData->links()}}
                </div>
                <div class="btn_group">
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回" >
                </div>
            </form>

        </div>
    </div>
    <!--搜索结果页面 列表 结束-->

    <script>
        //删除分类
        function delnav(conf_id) {
            layer.confirm('您确定要删除这个配置项吗？', {
                btn: ['是','否'] //按钮
            }, function(){
                $.post('{{url('admin/conf/')}}/'+conf_id,{'_method':'delete','_token':'{{csrf_token()}}'},function (data) {
                    if (data.status == 0){
                        layer.msg(data.msg,{icon:6});
                        setTimeout(location.href = location.href,3000);
                    }else {
                        layer.msg(data.msg,{icon:5});
                    }
                });
            });
        }

        //排序
        function changeOrder(obj,conf_id) {
            var conf_order = $(obj).val();
            $.post('{{url('admin/conf/changeorder')}}',{'_token':'{{csrf_token()}}','conf_id':conf_id,'conf_order':conf_order},function (data) {
                if (data.status == 0){
                    layer.msg(data.msg,{icon:6});
                }else {
                    layer.msg(data.msg,{icon:5});
                }
            })
        }

    </script>
@endsection
