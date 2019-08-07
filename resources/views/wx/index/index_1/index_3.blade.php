<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<center>
    <h2>信息展示</h2>
    <h3><a href="{{url('wx/index/index_1/index_2')}}">数据刷新</a></h3>
    <table border>
        <tr>
            <td>编号</td>
            <td>名</td>
            <td>时间</td>
            <td>openid</td>
            <td>是否关注</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->ming}}</td>
            <td>{{date ('Y-m-d H:i:s',$v->add_time)}}</td>
            <td>{{$v->openid}}</td>
            <td>
                @if($v->subscribe==1)
                    已关注
                @else
                    未关注
                @endif
            </td>
            <td>
                <a href="{{url('wx/index/index_1/index_4',['id'=>$v->id])}}">查看详情</a>
            </td>
        </tr>
        @endforeach
        <a href="{{url('wx/index/index_1/login')}}">第三方微信登录</a><br>

    </table>
</center>
</body>
</html>