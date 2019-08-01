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
<link href="{{asset('css/app.css')}}" rel="stylesheet">
<form action="">
    <input type="text" name="cfd" value="{{$cfd}}">出发地
    <input type="text" name="ddd" value="{{$ddd}}">到达地
    <input type="submit" value="搜索">
</form>
@if($name=='')

@elseif($name!='')
    <p>已浏览{{$name}}</p>
@endif

    <table border>

        <tr>
            <td>车次</td>
            <td>出发地</td>
            <td>到达地</td>
            <td>价钱</td>
            <td>到达时间</td>
            <td>票数</td>
            <td>操作</td>
        </tr>
        @foreach($datas as $v)
        <tr>
            <td>{{$v['cc']}}</td>
            <td>{{$v['cfd']}}</td>
            <td>{{$v['ddd']}}</td>
            <td>{{$v['jq']}}</td>
            <td>{{date('Y-m-d H:i:s',$v['ddsj'])}}</td>
            <td>
                @if($v['ps']==0)
                        无票
                @elseif($v['ps']<100)
                    {{$v['ps']}}
                @else($v['ps']>=100)
                    有票
                @endif
            </td>
            <td>
                @if($v['ps']==0)
                    <button type="button" disabled>购票 </button>
{{--                    <a href="" type="button" disabled>购票</a>--}}
                @elseif($v['ps']>0)
                    <a href="{{url('zho/login/update',['id'=>$v['id']])}}">购票</a>
                @endif
            </td>
        </tr>
            @endforeach
    </table>
{{--{{ $datas->links() }}--}}
</body>
</html>