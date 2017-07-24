<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('info')
    <link href="{{asset('resources/views/home/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('resources/views/home/css/new.css')}}" rel="stylesheet">
</head>
<body>
<header>
    <div id="logo"><a href="{{url('/')}}"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $k => $v)
        <a href="{{url($v['nav_url'])}}"><span>{{$v['nav_name']}}</span><span class="en">{{$v['nav_alias']}}</span></a>
        @endforeach
    </nav>
    </nav>
</header>
@section('content');
    <h3>
        <p>最新<span>文章</span></p>
    </h3>
    <ul class="rank">
        @foreach($newData as $k => $v)
            <li><a href="{{'a/'.$v['art_id']}}" title="{{$v['art_title']}}" target="_blank">{{$v['art_title']}}</a></li>
        @endforeach
    </ul>
    <h3 class="ph">
        <p>点击<span>排行</span></p>
    </h3>
    <ul class="paih">
        @foreach($hotarts as $k => $v)
            <li><a href="{{'a/'.$v['art_id']}}" title="{{$v['art_title']}}" target="_blank">{{$v['art_title']}}</a></li>
        @endforeach
    </ul>

@show
<footer>
    <p> {!!Config('web_conf.copyright')!!} <a href="/">网站统计</a></p>

</footer>
<!--[if lt IE 9]>
<script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
<![endif]-->
</body>
</html>
