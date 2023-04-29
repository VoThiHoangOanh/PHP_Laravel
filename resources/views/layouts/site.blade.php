<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/css/responsive.css')}}" rel="stylesheet">   
	@yield('header')
    <link rel="shortcut icon" href="public/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('public/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('public/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('public/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('public/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6 ">
                    Chào Mừng Bạn Đã Ghé Thăm Shop Thời Trang Hoàng Oanh !!!
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="{{ asset('public/images/home/logo7.png')}}" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<!-- <li><a href="#"><i class="fa fa-user"></i> Tài Khoản</a></li> -->
								<!-- <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Đăng xuất</a></li> -->
								<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>

								<li><a href="{{route('postlogin')}}" ><i class="fa fa-user"></i> Đăng nhập/Đăng ký</a></li>

							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->

<!-- gọi tên file của main-menu -->
		<x-main-menu/>  
		
	</header><!--/header-->
	
	<x-slidershow/>
	
	<section>
		<div class="container">
			<div class="row">
								
				@yield('content')
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Dịch vụ</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Hổ trợ trực tuyến</a></li>
								<li><a href="#">Liên hệ chúng tôi</a></li>
								<li><a href="#">Tình trạng đơn hàng</a></li>
				
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Tài khoản</h2>
							<ul class="nav nav-pills nav-stacked">
                            <li> <a href="#"> Đăng nhập người dùng </a></li>
                            <li> <a href="#"> Đăng ký người dùng </a></li>
                            <li> <a href="#"> Tạo tài khoản </a></li>
                            <li> <a href="#"> Đơn đặt hàng của tôi </a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Chính sách khách hàng</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Chính sách mua hàng</a></li>
								<li><a href="#">Chính sách bảo hành</a></li>
								<li><a href="#">Chính sách đổi sản phẩm</a></li>
								<li><a href="#">Giao hàng- Thanh toán</a></li>
								<li><a href="#">Bảo mật thông tin</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Giới Thiệu</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Thông tin công ty</a></li>
								<li><a href="#">Vị trí cửa hàng</a></li>
								<li><a href="#">Liên hệ</a></li>
								
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>Thông tin liên hệ</h2>
                            <ul class="nav nav-pills nav-stacked">
								<li><a href="#">CSKH</a></li>
								<li><a href="#">Mua hàng</a></li>
								<li><a href="#">Email</a></li>
								
							</ul>
							<form action="#" class="searchform">
								<input type="text" placeholder="Email của bạn" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="text-center">Thiết kế bởi: <span><a target="_blank" href="">Hoàng Oanh</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="{{asset('public/js/jquery.js')}}"></script>
	<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/js/price-range.js')}}"></script>
    <script src="{{asset('public/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/js/main.js')}}"></script>
    <script src="{{asset('public/js/jquery-1.12.4.js')}}" type="text/javascript"></script>
	@yield('footer')
</body>
</html>