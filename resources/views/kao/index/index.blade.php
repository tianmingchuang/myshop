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
    <form action="{{url('kao/index/index_do')}}" method="post">
        <h3>留言板</h3>
@csrf
        <textarea name="a_name" placeholder="请输入内容" class="layui-textarea"></textarea><br>
        <input type="submit" value="发布">
        </div>
    </form>
    <br>
    <table border>
        <h3>留言板列表</h3>当前浏览次数{{$name}}次
        <form action="">
            <input type="text" name="c_name" id="">
            <input type="submit" value="搜索">
        </form>
        <tr>
            <td>编号</td>
            <td>留言内容</td>
            <td>姓名</td>
            <td>时间</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->ly}}</td>
            <td>{{$v->xm}}</td>
            <td>{{date ('Y-m-d H:i:s',$v->time)}}</td>
            <td>
                @if(($value->id)==($v->user))
                    @if(($v->time)+1800>=time())
                        <a href="{{url('kao/index/index_1',['id'=>$v->id])}}">删除</a>
                    @elseif(($v->time)+1800<=time())
                        <a href="">删除</a>
                    @endif
                @elseif(($value->id)!==($v->user))
                        无权
                @endif


            </td>
        </tr>
        @endforeach
    </table>
</center>
</body>
</html>