@extends('admin.layout.login')
@section('title','注册')
@section('body')
<!-- register -->
	<div class="pages section">
		<div class="container">
			<div class="pages-head">
				<h3>REGISTER</h3>
			</div>
			<div class="register">
				<div class="row">
                	<form class="col s12" action="{{url('admin/login/register_do')}}" method="post">
                    @csrf
						<div class="input-field">
							<input type="text" class="validate" placeholder="NAME" required name="c_name">
						</div>
						<div class="input-field">
							<input type="email" placeholder="EMAIL" class="validate" required name="yx">
						</div>
						<div class="input-field">
							<input type="password" placeholder="PASSWORD" class="validate" required name="password">
						</div>
						<!-- <div class="btn button-default">REGISTER</div> -->
                        <button class="btn button-default">REGISTER</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end register -->
    @endsection