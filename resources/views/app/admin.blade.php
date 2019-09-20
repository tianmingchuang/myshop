<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">

    <title> hAdmin- 主页</title>

    <meta name="keywords" content="">
    <meta name="description" content="">

    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->

    <link rel="shortcut icon"  href="{{asset('hAdmin/favicon.ico')}}"> <link  href="{{asset('hAdmin/css/bootstrap.min.css?v=3.3.6')}}" rel="stylesheet">
    <link  href="{{asset('hAdmin/css/font-awesome.min.css?v=4.4.0')}}" rel="stylesheet">
    <link  href="{{asset('hAdmin/css/animate.css')}}" rel="stylesheet">
    <link  href="{{asset('hAdmin/css/style.css?v=4.1.0')}}" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden" >
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
{{--                                    <span class="block m-t-xs" style="font-size:20px;">--}}
{{--                                        <i class="fa fa-area-chart"></i>--}}
{{--                                        <strong class="font-bold">hAdmin</strong>--}}
{{--                                    </span>--}}
                                </span>
                        </a>
                    </div>
                    <div class="logo-element">hAdmin
                    </div>
                </li>
                <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                    <span class="ng-scope">分类</span>
                </li>
                <li>
                    <a class="J_menuItem" href="{{url('/')}}">
                        <i class="fa fa-home"></i>
                        <span class="nav-label">主页</span>
                    </a>
                </li>
                <li>
                    <a href="#">
{{--                        <i class="fa fa fa-bar-chart-o"></i>--}}
                        <span class="nav-label">商品类型</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{url('app/admin/select_attribute')}}">商品属性</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{url('app/admin/select_type')}}">商品类型</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{url('app/admin/select_category')}}">商品分类</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{url('app/admin/insert_sptianjia')}}">商品添加</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{url('app/admin/admin')}}">商品展示</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="">

            @section('body')
            @show
        </div>
        </div>
    </div>
    <!--右侧部分结束-->
</div>
{{--<link rel="stylesheet" href="{{asset('bootstrap/bootstrap.min.css')}}">--}}
{{--<script src="{{asset('bootstrap/bootstrap.min.js')}}"></script>--}}
{{--<script src="{{asset('bootstrap/jquery.min.js')}}"></script>--}}
<!-- 全局js -->
<script  src="{{asset('hAdmin/js/jquery.min.js?v=2.1.4')}}"></script>
<script  src="{{asset('hAdmin/js/bootstrap.min.js?v=3.3.6')}}"></script>
<script  src="{{asset('hAdmin/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
<script  src="{{asset('hAdmin/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
<script  src="{{asset('hAdmin/js/plugins/layer/layer.min.js')}}"></script>

<!-- 自定义js -->
<script  src="{{asset('hAdmin/js/hAdmin.js?v=4.1.0')}}"></script>
<script type="text/javascript"  src="{{asset('hAdmin/js/index.js')}}"></script>

<!-- 第三方插件 -->
<script  src="{{asset('hAdmin/js/plugins/pace/pace.min.js')}}"></script>
<div style="text-align:center;">
    <p>来源:<a  href="{{asset('hAdmin/http://www.mycodes.net/')}}" target="_blank">源码之家</a></p>
</div>
</body>

</html>
