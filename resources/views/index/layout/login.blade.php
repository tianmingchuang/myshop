<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>@yield('title','layout 后台大布局 - Layui')</title>
    <link rel="stylesheet" href="/layui/css/layui.css">
    <link rel="stylesheet" href="/layui/css/layui.css">
    <script src="/layui/layui.js"></script>
    <script src="/jquery.js"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
    <div class="layui-header">
        <div class="layui-logo">layui 后台布局</div>
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav layui-layout-left">
            <li class="layui-nav-item"><a href="">控制台</a></li>
            <li class="layui-nav-item"><a href="">商品管理</a></li>
            <li class="layui-nav-item"><a href="">用户</a></li>
            <li class="layui-nav-item">
                <a href="javascript:;">其它系统</a>
                <dl class="layui-nav-child">
                    <dd><a href="">邮件管理</a></dd>
                    <dd><a href="">消息管理</a></dd>
                    <dd><a href="">授权管理</a></dd>
                </dl>
            </li>
        </ul>
        <ul class="layui-nav layui-layout-right">
            <li class="layui-nav-item">
                <a href="javascript:;">
                    <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="">基本资料</a></dd>
                    <dd><a href="">安全设置</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="{{url('index/index/tl')}}">退了</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree">
                <!--lay-filter="test"-->
                <li class="layui-nav-item">
                    <!--  layui-nav-itemed" -->
                    <a class="" href="javascript:;">用户管理</a>
                    <dl class="layui-nav-child">
                        <dd><a href="{{url('index/index/login')}}">添加用户</a></dd>
                        <dd><a href="{{url('index/index/logins')}}">用户登录</a></dd>
                        <dd><a href="{{url('index/index/loginss')}}">用户展示</a></dd>
                        <dd><a href="{{url('index/index/hmd_do')}}">黑名单</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">商品品牌</a>
                    <dl class="layui-nav-child">
                        <dd><a href="{{url('index/index/index')}}">商品品牌添加</a></dd>
                        <dd><a href="{{url('index/index/ecaa')}}">商品品牌展示</a></dd>
                        <dd><a href="">超链接</a></dd>
                    </dl>
                </li>

                <li class="layui-nav-item">
                    <a href="javascript:;">微信测试</a>
                    <dl class="layui-nav-child">
                        <dd><a href="{{url('wx/index/index_1/index_3')}}">关注用户展示</a></dd>
                        <dd><a href="{{url('wx/index/index_1/index_5')}}">微信上传素材</a></dd>
                        <dd><a href="{{url('wx/index/index_1/get_yonghu')}}">用户标签添加</a></dd>
                        <dd><a href="{{url('wx/index/index_1/get_yonghu_do')}}">用户标签展示</a></dd>
                        <dd><a href="{{url('wx/index/index_1/erwmas')}}">二维码</a></dd>
                        <dd><a href="{{url('wx/index/index_1/shanghu')}}">二维码商户添加</a></dd>
                        <dd><a href="{{url('wx/index/index_1/caidan_1')}}">微信菜单添加</a></dd>
                        <dd><a href="{{url('wx/index/index_1/caidan_2')}}">微信菜单展示</a></dd>
                    </dl>
                </li>

                <li class="layui-nav-item">
                    <a href="javascript:;">微信练题</a>
                    <dl class="layui-nav-child">
                        <dd><a href="{{url('wx/index/index_2/index')}}">表白题试</a></dd>
                        <dd><a href="{{url('wx/index/index_2/index_1')}}">表白题试展示</a></dd>
                        <dd><a href="">超链接</a></dd>
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