@extends('admin.layout.login')
@section('title','登录')
@section('body')

<div class="pages section">
		<div class="container">
			<div class="pages-head">
				<h3>LOGIN</h3>
			</div>
			<div class="login">
				<div class="row">
					<form class="col s12" action="{{url('admin/login/login_do')}}" method="post">
                    @csrf
						<div class="input-field">
							<input type="text" class="validate" placeholder="USERNAME" required name="c_name">
						</div>
						<div class="input-field">
							<input type="password" class="validate" placeholder="PASSWORD" required name="password">
						</div>
						<a href=""><h6>Forgot Password ?</h6></a>
						<!-- <a href="" class="btn button-default">LOGIN</a> -->
                        <button class="btn button-default">LOGIN</button>
					</form>
				</div>
			</div>
		</div>
	</div>
    @endsection