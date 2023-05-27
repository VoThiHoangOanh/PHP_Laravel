@extends('layouts.site')
@section('title', 'Giỏ hàng')
@section('header')
<script src="{{asset('public/js/main.js')}}"></script>
@endsection
@section('content')

<!-- <div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                <h3 class='text-center'>GIỎ HÀNG CỦA BẠN</h3>
                </div>
            </div>
        </div>
    </div>
</div> -->

<section class="shopping-cart spad">
        <div class="container">
        @if(Session::has("Cart") !=null)
            <div class="row">
                <div class="col-lg-12" id="list-cart">
                <div class="cart-table">
                <table>
                    <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th class="p-name">Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số Lượng</th>
                            <th>Thành Tiền</th>
                            <th>Save</th>
                            <th>Delete</th>
                        </tr>

                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th  class="close-td"><a href="{{route('frontend.home')}}" class="btn btn-info btn-sm">Mua thêm</a></th>
                            <th class="close-td first-row edit-all" ><i class="ti-save"></i></th>
                            <th class="close-td first-row del-all"><i class="ti-close"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(Session::has("Cart") !=null)
                        @foreach(Session::get("Cart")->products as $item)
                        @php
                            $product_image =  $item['img'];
                            $hinh=null;
                            if(count($product_image)>0)
                            {
                            $hinh = $product_image[0]["image"];
                            }
                            
                        @endphp
                        <tr>
                            <td class="cart-pic first-row"><img width="100px" src="{{ asset('public/images/product/'.$hinh)}}" alt="{{$hinh}}"></td>
                            <td class="cart-title first-row">
                                <h5>{{$item['productinfo']->name}}</h5>
                            </td>
                            <td class="p-price first-row">{{number_format($item['productinfo']->price_buy)}} đ</td>
                            <td class="qua-col first-row">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input data-id="{{$item['productinfo']->id}}"  id="quanty-item-{{$item['productinfo']->id}}" type="text" value="{{$item['qty']}}">
                                    </div>
                                </div>
                            </td>
                            <td class="total-price first-row">{{number_format($item['price_buy'])}} đ</td>
                            <td class="close-td first-row"><i onclick="SaveListCart({{$item['productinfo']->id}});" class="ti-save"></i></td>
                            <td class="close-td first-row"><i class="ti-close" onclick="DeleteListCart({{$item['productinfo']->id}});"></i></td>
                        </tr>
                        @endforeach
                        @endif    
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 offset-lg-8">
                    <div class="proceed-checkout">
                    @if(Session::has("Cart") !=null)
                        <ul>
                            <li class="subtotal">Tổng số lượng <span>{{Session::get("Cart")->totalqty}}</span></li>
                            <li class="cart-total">Thành tiền <span>{{number_format(Session::get("Cart")->totalprice_buy)}} đ</span></li>
                        </ul>
                        <a href="{{route('giohang.checkout')}}" class="proceed-btn ">Đặt hàng</a>
                    @endif 
                    </div>
                </div>
            </div>
                </div>
            </div>
            @else
                <div class="text-center"><h2>Giỏ hàng trống</h2></div>
            @endif
        </div>
    </section>
    <!-- Shopping Cart Section End -->	
@endsection

@section('footer')
<script>
        function DeleteListCart(id)
        {
            // console.log(id);
            $.ajax({
				url:'delete-list-cart/'+id,
				type:'GET',

			}).done(function(response){
				// console.log(response);
				RenderListCart(response);
                location.reload();
				alertify.success('Đã xoá sản phẩm thành công');
			});
        }

        function SaveListCart(id)
        { 
            // console.log(id);
            $.ajax({
				url:'save-list-cart/' + id + '/'+ $("#quanty-item-"+id).val(),
				type:'GET',

			}).done(function(response){
				RenderListCart(response);
                location.reload();
				alertify.success('Đã cập nhật sản phẩm thành công');
			});
        }
        
        function RenderListCart(response)
        {
            $("#list-cart").empty();
			$("#list-cart").html(response);

            var proQty = $('.pro-qty');
            proQty.prepend('<span class="dec qtybtn">-</span>');
            proQty.append('<span class="inc qtybtn">+</span>');
            proQty.on('click', '.qtybtn', function () {
                var $button = $(this);
                var oldValue = $button.parent().find('input').val();
                if ($button.hasClass('inc')) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // Don't allow decrementing below zero
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 0;
                    }
                }
                $button.parent().find('input').val(newVal);
            });

        }

        $(".edit-all").on("click", function (){
            var lists =[];
            $("table tbody tr td").each(function(){
                $(this).find("input").each(function() {
                    var element ={ key: $(this).data("id"), value: $(this).val()};
                    lists.push(element);
                    
                });
            });
            $.ajax({
				url:'save-all',
				type:'POST',
                // data: data,
                data : {
                    _token: '{{ csrf_token() }}',
                    data : lists,
                }
			}).done(function(response){
				// console.log(response);
				location.reload();
				alertify.success('Đã cập nhật sản phẩm thành công');
                
                
			});
        });


        $(".del-all").on("click", function (){
            var lists =[];
            $("table tbody tr td").each(function(){
                $(this).find("input").each(function() {
                    var element ={ key: $(this).data("id"), value: $(this).val()};
                    lists.push(element);
                    
                });
            });
            $.ajax({
				url:'delete-all',
				type:'POST',
                // data: data,
                data : {
                    _token: '{{ csrf_token() }}',
                    data : lists,
                }
			}).done(function(response){
				// console.log(response);
				location.reload();
				alertify.success('Đã xoá sản phẩm thành công');
                
                
			});
        });


    </script>
@endsection
