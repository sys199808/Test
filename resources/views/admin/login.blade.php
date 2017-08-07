@extends('layouts.admin')
@section('title','瓜子后台登录')
@section('content')
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>guazi</h1>
		<h2>欢迎使用瓜子管理平台</h2>
		<div class="form">
			@if(session('error'))
			<p style="color:red">{{ session('error') }}</p>
			@endif
			<form action="{{ url('admin/login') }}" method="post">
				{{ csrf_field() }}
				<ul>
					<li>
					<input type="text" name="ad_name" class="text" value="{{ old('ad_name') }}"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="ad_pass" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						{{--第一种 自定义验证码类--}}
						{{--<img src="{{ url('admin/yzm') }}" onclick="this.src='{{ url('admin/yzm') }}?'+Math.random()" alt="">--}}
						<a onclick="javascript:re_captcha();">
							<img src="{{ URL('/code/captcha/1') }}" id="127ddf0de5a04167a9e427d883690ff6">
						</a>
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
			<p><a href="#">返回首页</a> &copy; 2017 Powered by <a href="http://47.94.196.107" target="_blank">http://dasheng.com</a></p>
		</div>
	</div>
	<script type="text/javascript">
        function re_captcha() {
            $url = "{{ URL('/code/captcha') }}";
            $url = $url + "/" + Math.random();
            document.getElementById('127ddf0de5a04167a9e427d883690ff6').src = $url;
        }
	</script>
</body>
@endsection
