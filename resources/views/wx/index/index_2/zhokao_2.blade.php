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
        <h3>留言</h3>
        <form action="{{url('wx/index/index_2/zhokao_2_do')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$id}}">
            <input type="hidden" name="uid" value="{{$uid}}">
        <p>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">文本域</label>
            <div class="layui-input-block">
                <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
        </div>
        </p>
        <p>
            <input type="submit" value="留言">
        </p>
        </form>
    </center>
</body>
</html>