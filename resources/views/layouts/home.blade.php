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
        <a href="index.html"><span>{{$v['nav_name']}}</span><span class="en">{{$v['nav_alias']}}</span></a>
        @endforeach
    </nav>
    </nav>
</header>
@yield('content');
<footer>
    <p>Design by blog <a href="http://www.miitbeian.gov.cn/" target="_blank">http://www.blog.com</a> <a
                href="/">网站统计</a></p>
</footer>
<!--[if lt IE 9]>
<script src="{{asset('resources/views/home/js/modernizr.js')}}"></script>
<![endif]-->
</body>
</html>
