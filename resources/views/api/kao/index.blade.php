@extends('layout.admin')
@section('title','登录展示')
@section('body')
    <carter>
            <table class="table">
                <tr>
                    <td>appid</td>
                    <td>appsecret</td>
                    <td>安全域名</td>
                </tr>
                <tr>
                    <td>{{$login->appid}}</td>
                    <td>{{$login->appsecret}}</td>
                    <td>
                        <input type="hidden" name="login_id" value="{{$login->login_id}}">
                        <input type="text" name="yming" value="{{$login->yming}}" id="">
                        <input type="submit" value="确定">
                    </td>
                </tr>
            </table>
    </carter>
        <script>
            $('[type="submit"]').on('click',function(){
                // alert(1);
                var name = $('[type="text"]').val();
                var login_id = $('[type="hidden"]').val();
                // alert(name);
                // alert(login_id);
                $.ajax({
                    url : 'http://www.my_shop.com/api/kao/index_do',
                    data : {name:name,login_id:login_id},
                    type : 'post',
                    dataType : 'json',
                    success : function(res){
                        alert(res.msg);
                        // location.href = 'login_do';
                    }
                })
            })
        </script>
@endsection