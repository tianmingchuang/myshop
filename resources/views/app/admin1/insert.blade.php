@extends('layout.admin')
@section('title','添加')
@section('body')
    <center>
        <table class="table">
            <tr>
                <td>商品名称</td>
                <td><input type="text" name="name" id="name"></td>
            </tr>
            <tr>
                <td>商品价格</td>
                <td><input type="text" name="price" id="price"></td>
            </tr>
            <tr>
                <td>图片</td>
                <td><input type="file" name="pic" id="pic">
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button class="tijiao">提交</button></td>
            </tr>
        </table>
    </center>
    <script>
    $('.tijiao').on('click',function () {
        var fo = new FormData();
        var file = $("[name='pic']")[0].files[0];
        var name = $('#name').val();
        var price = $('#price').val();
        // var pic = $('#pic').val();
        fo.append('file',file);
        // console.log( fo);return;
        fo.append('name',name);
        fo.append('price',price);
        $.ajax({
            url : "{{url('app/index_2')}}",
            data : fo,
            dataType : 'json',
            type : 'post',
            processData : false,
            contentType : false,
            success : function (res) {
                alert(res.msg);
                if(res.code == 200){
                    location.href = "{{url('app/admin/select')}}";
                }
            }
        })
    })
    </script>
@endsection