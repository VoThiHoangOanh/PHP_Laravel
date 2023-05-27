@extends('layouts.site')
@section('title', 'Giỏ hàng')
@section('header')
    <link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	
@endsection

@section('content')
<div class="container">
		<div id="content">
            @if(Session::has('thongbao'))
                <div class ="alert alert-success">{{Session::get('thongbao')}}</div>
            @endif
            <form action="{{route('giohang.postcheckout')}}" method="post" enctype="multipart/form-data">
            @csrf
				<div class="row">
                    <div class="col-sm-6 ">
                        <!-- <div class="col-lg-9 offset-lg-8"> -->
                            <h4>THÔNG TIN KHÁCH HÀNG</h4>
                            <div class="space20 ">&nbsp;</div>
                            <div class="form-block ">
                                <label for="name" style="width:30%" >Họ tên*</label>
                                <input type="text" style="width:60%" id="name" name="name" placeholder="Tên khách Hàng" required>
                            </div>

                            <div class="form-block">
                                <label for="adress" style="width:30%">Giới tính*</label>
                                <input type="radio"  style="width:10%" name="gender" value="Nam" checked="checked" ><span style="padding-right 20%;">Nam</span>
                                <input type="radio"  style="width:10%" name="gender" value="Nữ" checked="checked" ><span>Nữ</span>
                            </div>

                            <div class="form-block">
                                <label for="adress" style="width:30%">Địa chi*</label>
                                <input type="text" style="width:60%" id="address" name="address" placeholder="Địa Chỉ Giao Hàng" required>   
                            </div>

                             <div class="form-block">
                                <label for="email" style="width:30%">Email*</label>
                                <input type="email"style="width:60%" name="email" placeholder="example@gmail.com" required>
                             </div>

                            <div class="form-block">
                                <label for="phone" style="width:30%">Điện thoại thoại*</label>
                                <input type="text"style="width:60%" name="phone" placeholder="Số Điện Thoại" required> 
                            </div>
                                
                            <div class="form-block">
                                <label for="notes" style="width:30%">Ghi chú*</label>
                                <textarea  name="notes" style="width:60%" required> </textarea>
                            </div>
                        <!-- </div> -->
                    </div>
					
					<div class="col-sm-6">
						<div class="your-order">
                        @if(Session::has("Cart") !=null)
							<div class="your-order-head"><h4>ĐƠN HÀNG CỦA BẠN</h4></div>
                            <div class="your-order-body">
								<div class="your-order-item">
                               
                                @foreach(Session::get("Cart")->products as $item)
                                    @php
                                        $product_image =  $item['img'];
                                        $hinh=null;
                                        if(count($product_image)>0)
                                        {
                                        $hinh = $product_image[0]["image"];
                                        }
                                        
                                    @endphp
									<div  class="row">
									<!--  one item	 -->
										<div class="media col-md-4">
                                            <img width="100px" src="{{ asset('public/images/product/'.$hinh)}}" alt="{{$hinh}}">
                                        </div>
										<div class="media-body col-md-8">
											<p class="font-large">{{$item['productinfo']->name}}</p>
											<span class="color-gray your-order-info">Số lượng:  <span>{{$item['qty']}}</span></br>
											<span class="color-gray your-order-info">Giá tiền:  <span>{{number_format($item['productinfo']->price_buy)}} đ</span>
										</div>
										
									<!-- end one item -->
									</div>
                                @endforeach
                               
									<div class="clearfix"></div>
                                
								</div>
								<div class="your-order-item">
									<div class="pull-left" style="width:30%" ><h4 class="your-order-f18">Tổng tiền:</h4></div>
									<div class="pull-right" style="width:60%"><h4 class="color-black">{{number_format(Session::get("Cart")->totalprice_buy)}} đ</h4></div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="your-order-head"><h5>HÌNH THỨC THANH TOÁN</h5></div>
							
                            <div class="row">
                                <div class="col-lg-9 offset-lg-8">
                                    <div class="proceed-checkout">
                                        <ul>
                                        <li class="payment_method_bacs">
                                            <input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="OCD" checked="checked" data-order_button_text="">
                                            <label for="payment_method_bacs">Thanh toán trực tiếp </label>
                                                                
                                        </li>
                                        <li class="payment_method_cheque">
                                            <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
                                            <label for="payment_method_cheque">Thanh toán bằng chuyển khoản </label>						
                                        </li>
                                        
                                        </ul>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success">
                                            Mua ngay
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endif
						</div> <!-- .your-order -->
					</div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->


@endsection



                
                



