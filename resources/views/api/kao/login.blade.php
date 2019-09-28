@extends('layout.admin')
@section('title','注册')
@section('body')
    <carter>
        <table class="table">
            <tr>
                <td>用户名</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="pwd" id=""></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="注册"></td>
            </tr>
        </table>
    </carter>
    <script>
        $('[type="submit"]').on('click',function(){
            // alert(1);
            var name = $('[type="text"]').val();
            var pwd = $('[type="password"]').val();
            $.ajax({
                url : 'http://www.my_shop.com/api/kao/login',
                data : {name:name,pwd:pwd},
                type : 'post',
                dataType : 'json',
                success : function(res){
                    alert(res.msg);
                    location.href = 'login_do';
                }
            })
        })
    </script>
@endsection