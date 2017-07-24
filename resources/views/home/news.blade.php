@extends('layouts.home')
@section('info')
    <title>{{$art['art_title']}} - {{Config('web_conf.web_title')}}</title>
    <meta name="keywords" content="{{$art['art_tag']}}" />
    <meta name="description" content="{{$art['art_description']}}" />
@endsection
@section('content')
    <article class="blogs">
        <h1 class="t_nav"><span>您当前的位置：<a href="{{url('/')}}">首页</a>&nbsp;&gt;&nbsp;<a href="{{url('cate/'.$art['cate_id'])}}">{{$art['cate_name']}}</a></span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('cate/'.$art['cate_id'])}}" class="n2">{{$art['cate_name']}}</a></h1>
        <div class="index_about">
            <h2 class="c_titile">{{$art['art_title']}}</h2>
            <p class="box_c"><span class="d_time">发布时间：{{date('Y-m-d',$art['art_time'])}}</span><span>编辑：{{$art['art_editor']}}</span><span>查看次数：{{$art['art_view']}}</span></p>
            <ul class="infos">
                {!! $art['art_content'] !!}
            </ul>
            <div class="keybq">
                <p><span>关键字词</span>：{{$art['art_tag']}}</p>
            </div>
            <div class="ad"> </div>
            <div class="nextinfo">
                <p>上一篇：
                    @if($artPre)
                        <a href="{{url('a/'.$artPre['art_id'])}}">{{$artPre['art_title']}}</a></p>
                    @else
                        <span>没有上一篇了</span>
                    @endif
                <p>下一篇：
                    @if($artNext)
                        <a href="{{url('a/'.$artNext['art_id'])}}">{{$artNext['art_title']}}</a></p>
                    @else
                        <span>没有下一篇了</span>
                    @endif
            </div>
            <div class="otherlink">
                <h2>相关文章</h2>
                <ul>
                    @foreach($artRelate as $k => $v)
                    <li><a href="{{url('a/'.$v['art_id'])}}" title="{{$v['art_title']}}">{{$v['art_title']}}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <aside class="right">
            <!-- Baidu Button BEGIN -->
            <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
            <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
            <script type="text/javascript" id="bdshell_js"></script>
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
            </script>
            <!-- Baidu Button END -->
            <div class="blank"></div>
            <div class="news">
                @parent
            </div>
        </aside>
    </article>
@endsection