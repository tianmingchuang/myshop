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
    <form action="{{url('wx/index/index_2/index_41')}}" method="post">
        <table>
            @csrf
            <tr>
                <th>是否匿名发送</th>
                <th>
                    <input type="radio" name="radio" value="匿名用户" id="">是
                    <input type="radio" name="radio" value="{{$name}}" id="">否
                </th>
            </tr>
            <tr>
                <td>表白内容:</td>
                <td>
                    <div class="layui-form-item layui-form-text">
                        <div class="layui-input-block">
                            <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
                        </div>
                    </div>
                </td>
            </tr>
            <input type="hidden" name="openid" value="{{$openid}}">
            <tr>
                <td></td>
                <td><input type="submit" value="表白"></td>
            </tr>
        </table>
    </form>
</center>
</body>
</html>