@extends('layout.admin')
@section('title','天气登录')
@section('body')
    <center>
{{--        <form action="{{url('api/index_1/login_do')}}" method="post">--}}
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
                    <td><input type="submit" value="登录"></td>
                </tr>
            </table>
{{--        </form>--}}
    </center>
    <script>
        $('[type="submit"]').on('click',function(){
            // alert(1);
            var name = $('[type="text"]').val();
            var pwd = $('[type="password"]').val();
            // alert(name);
            $.ajax({
                url : 'http://www.my_shop.com/api/index_1/login_do',
                data : {name:name,pwd:pwd},
                dataType : 'json',
                type : 'post',
                success : function(res){
                    alert(res.msg);
                    if(res.code==200){
                        location.href = 'http://www.my_shop.com/api/index_1/select?token='+res.msg;
                    }
                }
            })
        })
    </script>
@endsection