@extends('layout.admin')
@section('title','添加')
@section('body')
    <center>
        <p align="center">
            商品名称<input type="text" name="name" id="" class="form-group" value=""><br>
            商品价格<input type="text" name="price" id="" class="form-group" value=""><br>
            <input type="submit" value="搜索" id="sosuo">
        </p>
        <table class="table">
            <tr>
                <td>商品编号</td>
                <td>商品名称</td>
                <td>商品价格</td>
                <td>商品图片</td>
                <td>商品操作</td>
            </tr>
          <tbody id="zhan">

          </tbody>
        </table>
        <div id="yan">

        </div>
    </center>
    <script>
        var name = $('[name="name"]').val();
        var price = $('[name="price"]').val();
        $.ajax({
            url : "{{url('app/index_2')}}",
            type : 'get',
            data : {name:name,price:price},
            dataType : 'json',
            success : function (res) {
                // alert(1);
                pa(res)
            }
        })
        $(document).on('click','#sosuo',function () {
            // alert(1);
            $('#zhan tr').remove();
            var name = $('[name="name"]').val();
            var price = $('[name="price"]').val();
            $.ajax({
                url : "{{url('app/index_2')}}",
                type : 'get',
                data : {name:name,price:price},
                dataType : 'json',
                success : function (res) {
                    // alert(1);
                    pa(res)
                }
            })
        })

        $(document).on('click','.er',function () {
            $('#zhan tr').remove();
            var name = $('[name="name"]').val();
            var price = $('[name="price"]').val();
            var page = $(this).attr('value');
            $.ajax({
                url : "{{url('app/index_2')}}",
                type : 'get',
                data : {page:page,name:name,price:price},
                dataType : 'json',
                success : function (res) {
                    // alert(1);
                    pa(res)
                }
            })
        })

        $(document).on('click','#xiugai' ,function () {
            var id = $(this).attr('value');
            // alert(id);
            location.href = "{{url('app/admin/updata')}}?ids="+id;
            return false
        })

        $(document).on('click','#shanchu',function () {
            var id = $(this).attr('value');
            $.ajax({
                url : "{{url('app/index_2')}}"+'/'+id,
                type : 'DELETE',
                // data : {},
                dataType : 'json',
                success : function (res) {
                    alert(res.msg);
                    if(res.code==200){
                        $(this).parents('tr').remove();
                    }
                    // pa(res)
                }
            })
        })

        function pa(res){
            $.each(res.msg.data,function (k ,v) {
                var tr = $("<tr></tr>");
                tr.append("<td>"+v.id+"</td>");
                tr.append("<td>"+v.name+"</td>");
                tr.append("<td>"+v.price+"</td>");
                tr.append("<td>"+"<img src='/tupian/"+v.pic+"' width='50' alt=''>"+"</td>");
                tr.append("<td><a href='javascript:;' value='"+v.id+"' id='shanchu'>删除</a><a href='javascript:;' value='"+v.id+"' id='xiugai'>修改</a></td>");
                $('#zhan').append(tr);
            })
            var page = '';
            for (var i=1;i<=res.msg.last_page;i++){
                page +="<a herf='javascript:;' value='"+i+"' class='er'>第"+i+"页</a>";
            }
            $('#yan').html(page);
        }
    </script>
@endsection