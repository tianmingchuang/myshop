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
    <form action="">
        姓名<input type="text" name="name" value="{{$name}}">
        年龄<input type="text" name="sae" value="{{$sae}}">
        <input type="submit" value="搜索">
    </form>
    <table border>
        <tr>
            <td>编号</td>
            <td>名</td>
            <td>年龄</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->c_name}}</td>
                <td>{{$v->c_sae}}</td>
                <td>
                    <a href="{{url('app/index/delete',['id'=>$v->id])}}">删除</a>
                    <a href="{{url('app/index/update',['id'=>$v->id])}}">修改</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $data->appends(['name' => $name,'sae'=>$sae])->links() }}
{{--    {{ $data->links() }}--}}
</center>
</body>
</html>