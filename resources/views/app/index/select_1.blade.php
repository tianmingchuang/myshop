@extends('layout.admin')
@section('title','展示')
@section('body')
{{--<center>--}}
<p align="center">
    姓名<input type="text" name="c_name" id="" class="form-group" value=""><br>
    年龄<input type="text" name="c_sae" id="" class="form-group" value=""><br>
    <input type="submit" value="搜索" id="sosuo">
</p>
<table class="table table-bordered table-hover ">

        <tr align="center">
            <td>姓名</td>
            <td>年龄</td>
            <td>操作</td>
        </tr>
        <tbody id="zhan" align="center">

        </tbody>
    </table>
    <div id="fy" align="center">

    </div>
{{--</center>--}}
    <script>

    // function c(){
    //     alert("你点击了a标签！！");
    //     window.location.href="你要跳转的地址";
    // }

    var c_name = $("[name='c_name']").val();
    var c_sae = $("[name='c_sae']").val();
        $.ajax({
            type : 'get',
            url : "{{url('app/index_1')}}",
            data : {c_name:c_name , c_sae:c_sae},
            dataType: 'json',
            success:function(res) {
               pages(res)
            },
        })

        $(document).on('click','#fy a',function () {
            var c_name = $("[name='c_name']").val();
            var c_sae = $("[name='c_sae']").val();
            var _this = $(this);
            var page = _this.attr('value');
            // alert(page);
            $('#zhan tr').remove();
            $.ajax({
                url : "{{url('app/index_1')}}",
                data : {page:page,c_name:c_name , c_sae:c_sae},
                type : 'get',
                dataType : 'json',
                success : function (res) {
                    $("[name='c_name']").val(res.c_name);
                    $("[name='c_sae']").val(res.c_sae);
                    pages(res)
                }
            })
        })

        $(document).on('click','#sosuo',function () {
            $('#zhan tr').remove();
            var c_name = $("[name='c_name']").val();
            var c_sae = $("[name='c_sae']").val();
            // alert(c_sae);
            $.ajax({
                url : "{{url('app/index_1')}}",
                data : {c_name:c_name,c_sae:c_sae},
                type : 'get',
                dataType : 'json',
                success : function (res) {
                    pages(res)
                }
            })
        })

    function pages(res){
        $("[name='c_name']").val(res.c_name);
        $("[name='c_sae']").val(res.c_sae);
        $.each(res.msg.data,function(msg ,v){
            var tr = $('<tr></tr>');
            tr.append("<td class='none'>"+v.c_name+"</td>");
            tr.append("<td>"+v.c_sae+"</td>");
            tr.append("<td><a href='javascript:;' value='" + v.id + "' class='shanchu'>删除</a><a href='javascript:;' value='" + v.id + "' class='xiugai'>修改</a></td>");
            $('#zhan').append(tr);
        })
        var page = "";
        for (var i=1;i<=res.msg.last_page;i++){
            page += "<a href='javascript:;' value='" +i+ "' class='fy'>第"+i+"页</a>";
        }
        $('#fy').html(page);
    }

    $(document).on('click','.xiugai' ,function () {
        var id = $(this).attr('value');
        location.href = "{{url('app/index/updata_1')}}?ids="+id;
        return false
    })


    $(document).on('click','.shanchu', function () {
        // console.log(tr);
        var _this = $(this);
        var id = $(this).attr('value');
        $.ajax({
            url : "{{url('app/index_1')}}"+'/'+id,
            type : 'delete',
            dataType : 'json',
            success : function(res){
                alert(res.msg);
                // location.href = 'select_1';
                // var id = $(this).attr('value');
                // tr.remove();
                _this.parents('tr').hide();
            }
        })
        return false
    })
</script>
@endsection