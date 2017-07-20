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
            <div class="rnav">
                <ul>
                    <li class="rnav1"><a href="/download/" target="_blank">日记</a></li>
                    <li class="rnav2"><a href="/newsfree/" target="_blank">程序人生</a></li>
                    <li class="rnav3"><a href="/web/" target="_blank">欣赏</a></li>
                    <li class="rnav4"><a href="/newshtml5/" target="_blank">短信祝福</a></li>
                </ul>
            </div>
            <div class="news">
                <h3>
                    <p>最新<span>文章</span></p>
                </h3>
                <ul class="rank">
                    <li><a href="/" title="Column 三栏布局 个人网站模板" target="_blank">Column 三栏布局 个人网站模板</a></li>
                    <li><a href="/" title="with love for you 个人网站模板" target="_blank">with love for you 个人网站模板</a></li>
                    <li><a href="/" title="免费收录网站搜索引擎登录口大全" target="_blank">免费收录网站搜索引擎登录口大全</a></li>
                    <li><a href="/" title="做网站到底需要什么?" target="_blank">做网站到底需要什么?</a></li>
                    <li><a href="/" title="企业做网站具体流程步骤" target="_blank">企业做网站具体流程步骤</a></li>
                    <li><a href="/" title="建站流程篇——教你如何快速学会做网站" target="_blank">建站流程篇——教你如何快速学会做网站</a></li>
                    <li><a href="/" title="box-shadow 阴影右下脚折边效果" target="_blank">box-shadow 阴影右下脚折边效果</a></li>
                    <li><a href="/" title="打雷时室内、户外应该需要注意什么" target="_blank">打雷时室内、户外应该需要注意什么</a></li>
                </ul>
                <h3 class="ph">
                    <p>点击<span>排行</span></p>
                </h3>
                <ul class="paih">
                    <li><a href="/" title="Column 三栏布局 个人网站模板" target="_blank">Column 三栏布局 个人网站模板</a></li>
                    <li><a href="/" title="withlove for you 个人网站模板" target="_blank">with love for you 个人网站模板</a></li>
                    <li><a href="/" title="免费收录网站搜索引擎登录口大全" target="_blank">免费收录网站搜索引擎登录口大全</a></li>
                    <li><a href="/" title="做网站到底需要什么?" target="_blank">做网站到底需要什么?</a></li>
                    <li><a href="/" title="企业做网站具体流程步骤" target="_blank">企业做网站具体流程步骤</a></li>
                </ul>
            </div>
            <div class="visitors">
                <h3><p>最近访客</p></h3>
                <ul>

                </ul>
            </div>
            <!-- Baidu Button BEGIN -->
            <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
            <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
            <script type="text/javascript" id="bdshell_js"></script>
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
            </script>
            <!-- Baidu Button END -->
        </aside>
    </article>
@endsection
