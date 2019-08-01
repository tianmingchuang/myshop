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
{{--{{date("Y-m-d H:i:s",1563960856)}}--}}
<center>
<h3>竞猜列表</h3>
<table border>
    @foreach($data as $v)
        <tr>
            <td>{{$v->name1}}  &nbsp&nbsp&nbsp&nbspVS&nbsp&nbsp&nbsp {{$v->name2}}</td>

            <td>
                @if(($v->daans)==0)

                    @if(($v->shijian)>=time())
                        <a href="{{url('zho/login_3/login_do',['id'=>$v->id])}}">添加竞猜结果</a>
                    @elseif(($v->shijian)<=time())
                        <a href="{{url('zho/login_3/login_do_2',['id'=>$v->id])}}">添加竞猜结果</a>
                    @endif


                @elseif(($v->daans)!==0)
                    <a href="{{url('zho/login_3/ec',['id'=>$v->id])}}">查看竞猜结果</a>
                @endif
            </td>
        </tr>
    @endforeach
</table>
</center>
</body>
</html>