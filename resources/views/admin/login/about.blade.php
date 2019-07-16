@extends('admin.layout.login')
@section('title','首页')
@section('body')
	<!-- about us -->
	<div class="pages section">
		<div class="container">
			<div class="pages-head">
				<h3>ABOUT US</h3>
			</div>
			<div class="about-us">
				<img src="{{asset('mstore/img/about.jpg')}}" alt="">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore consequuntur praesentium dignissimos voluptatum esse, perspiciatis mollitia repellendus rerum magni aspernatur ipsam maxime dolorem iure laudantium at veritatis doloribus, numquam, dicta?</p>
			</div>
		</div>
	</div>
	<!-- end about us -->
@endsection
