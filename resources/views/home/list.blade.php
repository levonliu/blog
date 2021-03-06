@extends('layouts.home')
@section('info')
    <title>{{$art_list['cate_name']}} - {{Config('web_conf.web_title')}}</title>
    <meta name="keywords" content="{{$art_list['cate_keywords']}} " />
    <meta name="description" content="{{$art_list['cate_description']}} " />
@endsection
@section('content')
    <article class="blogs">
        <h1 class="t_nav"><span>“{{$art_list['cate_title']}}。</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url('cate/'.$art_list['cate_id'])}}" class="n2">{{$art_list['cate_name']}}</a></h1>
        <div class="newblog left">
            @foreach($artData as $k => $v)
            <h2>{{$v['art_title']}}</h2>
            <p class="dateview"><span>发布时间：{{date('Y-m-d',$v['art_time'])}}</span><span>作者：{{$v['art_editor']}}</span><span>分类：[<a href="{{url('cate/'.$art_list['cate_id'])}}">{{$art_list['cate_name']}}</a>]</span></p>
            <figure><img src="{{url($v['art_thumb'])}}"></figure>
            <ul class="nlist">
                <p>{{$v['art_description']}}</p>
                <a title="{{$v['art_title']}}" href="{{url('a/'.$v['art_id'])}}" target="_blank" class="readmore">阅读全文>></a>
            </ul>
            <div class="line"></div>
            @endforeach
            <div class="blank"></div>
            <div class="ad">
                <img src="images/ad.png">
            </div>
            <div class="page">
                {{$artData->links()}}
            </div>
        </div>
        <aside class="right">
            @if($submenu->all())
            <div class="rnav">
                <ul>
                    @foreach($submenu as $k => $v)
                    <li class="rnav{{$k+1}}"><a href="{{url('cate/'.$v['cate_id'])}}" target="_blank">{{$v['cate_name']}}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Baidu Button BEGIN -->
                <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
                <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
                <script type="text/javascript" id="bdshell_js"></script>
                <script type="text/javascript">
                    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
                </script>
                <!-- Baidu Button END -->
            <div class="news" style="float: left">
                @parent
            </div>
        </aside>
    </article>
@endsection
