@extends('index.layout.login')
@section('title','表白菜单')
@section('body')
    <center>
        <form action="{{url('wx/index/index_2/index_do')}}" method="post">
            @csrf
            <h3>微信表白菜单添加</h3>
            <br>
            <p>菜单:
                <select name="caidan" id="caidan">
                    <option value="1">一级菜单</option>
                    <option value="2">二级菜单</option>
                </select>
            </p>
            <br>
            <p>名称:
                <input type="text" name="yi_name" id="">
            </p>
            <br>
            <p>二级菜单名称:
                <input type="text" name="er_name" id="er_nmae">
            </p>
            <br>
            <p>菜单标识:
                <input type="text" name="biaoshi" id="">
            </p>
            <br>
            <p>上传类型:
                <input type="text" name="leixing" id="">
            </p>
            <br>
            <p><input type="submit" value="添加"></p>
        </form>
    </center>
@endsection
