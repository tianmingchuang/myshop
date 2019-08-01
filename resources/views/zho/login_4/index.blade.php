<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title','后台管理')</title>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <link rel="stylesheet" href="/layui/css/layui.css">
    <script src="/layui/layui.js"></script>
    <script src="/jquery.js"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">

        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">

            </li>
            <li class="layui-nav-item"><a href="{{url('index/index/tl')}}">退了</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree">
                <!--lay-filter="test"-->
                <li class="layui-nav-item">
                    <!--  layui-nav-itemed" -->
                    <a class="" href="javascript:;">物业管理系统</a>
                    <dl class="layui-nav-child">
                        <dd><a href="{{url('/zho/login_4/index_1')}}">添加车位信息</a></dd>
                        <dd><a href="{{url('zho/login_4/index_3')}}">数据统计</a></dd>
                        <dd><a href="{{url('zho/login_4/index_22')}}">添加门卫</a></dd>
                    </dl>
                </li>

            </ul>
        </div>
    </div>

    <div class="layui-body">
        <!-- 内容主体区域 -->
        @section('body')

        @show
    </div>

    <div class="layui-footer">
        <!-- 底部固定区域 -->
        都是弟弟
    </div>
</div>

<script>
    //JavaScript代码区域
    layui.use('element', function() {
        var element = layui.element;

    });
</script>
</body>
</html>