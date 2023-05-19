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
	<link href="{{asset('public/css/themify-icons.css')}}" rel="stylesheet">   
	<link href="{{asset('public/css/elegant-icons.css')}}" rel="stylesheet">   
	<link href="{{asset('public/css/nice-select.css')}}" rel="stylesheet">   
	<link href="{{asset('public/css/jquery-ui.min.css')}}" rel="stylesheet">   
	<link href="{{asset('public/css/slicknav.min.css')}}" rel="stylesheet">   
	<link href="{{asset('public/css/style.css')}}" rel="stylesheet">   


	@yield('header')
    <link rel="shortcut icon" href="public/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('public/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('public/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('public/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('public/images/ico/apple-touch-icon-57-precomposed.png')}}">
	<style>
		#change-item-cart table tbody tr td img
		{
			width: 70px;
		}
	</style>
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
		<div class="header-middle">
		<div class="container">
            <div class="inner-header">
                <div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="{{ asset('public/images/home/logo7.png')}}" alt="" /></a>
						</div>
					</div>
                    <div class="col-lg-8 text-right col-md-8">
					<ul class="nav-right">

							<li class="heart-icon">
							<a href="{{route('postlogin')}}" >
								<i class="fa fa-user"></i> Đăng nhập
							</a>
							</li>

                            <li class="heart-icon"><a href="#">
                                    <i class="icon_heart_alt"></i> Yêu thích
                                    <span>1</span>
                                </a>
                            </li>
                            <li class="cart-icon"><a href="#">
                                    <i class="fa fa-shopping-cart"></i> Giỏ hàng
									@if(Session::has("Cart") != null)
									<span id="total-quanty-show">{{Session::get("Cart")->totalqty}}</span>
									@else
									<span id="total-quanty-show">0</span>
									@endif
                                    
                                </a>
                                <div class="cart-hover">
									<div id="change-item-cart">
									@if(Session::has("Cart") !=null)
										<div class="select-items">
											<table>
												<tbody>
													@foreach(Session::get("Cart")->products as $item)
													@php
														$product_image =  $item['img'];;
														$hinh=null;
														if(count($product_image)>0)
														{
														$hinh = $product_image[0]["image"];
														}
													@endphp
													
													<tr>
													<td class="si-pic"><img src="{{ asset('public/images/product/'.$hinh)}}" alt="{{$hinh}}"></td>
														<td class="si-text">
															<div class="product-selected">
																<p>{{number_format($item['productinfo']->price_buy)}} đ  x {{$item['qty']}}</p>
																<h6>{{$item['productinfo']->name}}</h6>
															</div>
														</td>
														<td class="si-close">
															<i class="ti-close" data-id="{{$item['productinfo']->id}}"></i>
														</td>
													</tr>
													@endforeach                   
												</tbody>
											</table>
											</div>
											<div class="select-total">
												<span>total:</span>
												<h5>{{number_format(Session::get("Cart")->totalprice_buy)}} đ</h5>
											</div>
										  
										@endif                               

									</div>
                                    
                                    <div class="select-button">
                                        <a href="{{ route('giohang.list-cart') }}" class="primary-btn view-card">VIEW CARD</a>
                                        <a href="#" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>
</div>
<!-- gọi tên file của main-menu -->	
	</header><!--/header-->
	<x-main-menu/> 
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
    <script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('public/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('public/js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('public/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('public/js/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('public/js/jquery.dd.min.js')}}"></script>
    <script src="{{asset('public/js/jquery.slicknav.js')}}"></script>
    

	<!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
	<!-- Semantic UI theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
	<!-- JavaScript -->

	<script>
	function AddCart(id)
		{
			$.ajax({
				url:'addcart/'+id,
				type:'GET',

			}).done(function(response){
				// console.log(response);
				RenderCart(response);
				 alertify.success('Đã thêm mới sản phẩm');
			});
		}	
		$("#change-item-cart").on("click",".si-close i", 
		function (){
			$.ajax({
				url:'delete-cart/'+ $(this).data("id"),
				type:'GET',

			}).done(function(response){
				RenderCart(response);
				alertify.success('Đã xoá sản phẩm thành công');
			});
		});
		
		function RenderCart(response){
        // console.log(response)
        if (response)
        {
            $("#change-item-cart").empty();
            $("#change-item-cart").html(response);
            console.log($("#total-quanty-cart"));
            $("#total-quanty-show").text($("#total-quanty-cart").val());
        }
        else
        {
            $("#change-item-cart").empty();
            $("#total-quanty-show").text('0')
        }
		}

	</script>

	@yield('footer')
</body>
</html>