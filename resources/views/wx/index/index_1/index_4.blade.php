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
    <h3><a href="{{url('wx/index/index_1/index_3')}}">返回首页</a></h3>
    <table border>
        <tr>
            <td>名</td>
            <td>{{$data['nickname']}}</td>
        </tr>
        <tr>
            <td>openid</td>
            <td>{{$data['openid']}}</td>
        </tr>
        <tr>
            <td>地址</td>
            <td>{{$data['country']}}{{$data['province']}}{{$data['city']}}</td>
        </tr>
        <tr>
            <td>时间</td>
            <td>{{date ('Y-m-d H:i:s',$data['subscribe_time'])}}</td>
        </tr>
        <tr>
            <td>头像</td>
            <td><img src="{{$data['headimgurl']}}" width="40" alt=""></td>
        </tr>
        <tr>
            <td>是否关注</td>
            <td>
                @if($data['subscribe']==1)
                    已关注
                    @else
{{--                {{$data->subscribe}}--}}
                    未关注
                @endif
            </td>
        </tr>













    </table>
</center>
</body>
</html>