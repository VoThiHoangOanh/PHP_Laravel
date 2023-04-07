<div>
<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
							
                            @foreach ($list_menu as $row_menu)
							<li class="nav-item">
							<a class ="nav-link text-light text-uppercase" href="{{$row_menu->link}}">{{$row_menu->name}}</a>
							</li>

                            <!-- <li class="nav-item">

                                <a class ="nav-link" href="">{{$row_menu->name}}</a>
                            </li> -->
                            @endforeach
								<!-- <li class="dropdown"><a href="#">Tất cả danh mục sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Sản phẩm</a></li>
										<li><a href="product-details.html">Chi tiết sản phẩm</a></li> 
										<li><a href="cart.html">Giỏ hàng</a></li> 
										<li><a href="login.html">Đăng nhập</a></li> 
                                    </ul>
                                </li>  -->
								<li class="dropdown"><a href="#">Khuyến mãi<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Mã giảm giá</a></li>
										<li><a href="blog-single.html">Ngày sale cực sốc</a></li>
                                    </ul>
                                </li> 
								<li><a href="404.html">Dịch vụ</a></li>
								<li><a href="contact-us.html">Liên hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Tìm kiếm"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
</div>