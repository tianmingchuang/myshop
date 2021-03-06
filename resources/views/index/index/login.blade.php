@extends('index.layout.login')
@section('title','管理员注册')
@section('body')
    <form action="{{url('index/index/login_do')}}" method="post">
        <table border="">
            @csrf
            <div class="layui-form-item">
            <label class="layui-form-label">账号</label>
            <div class="layui-input-inline">
                <input type="text" name="c_name" autocomplete="off" class="layui-input">
            </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">邮箱</label>
                <div class="layui-input-inline">
                    <input type="email" name="yx" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码框</label>
                <div class="layui-input-inline">
                    <input type="password" name="password" autocomplete="off" class="layui-input">
                </div>
            </div>
            <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
        </table>
    </form>


@endsection