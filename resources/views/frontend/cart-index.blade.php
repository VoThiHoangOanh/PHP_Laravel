@extends('layouts.site')
@section('title', 'Giỏ hàng')
@section('content')

<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h5 class='text-center'>GIỎ HÀNG CỦA BẠN</h5>
            </div>
        </div>
    </div>
</div>

<section class="shopping-cart spad">
        <div class="container">
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
                    </thead>
                    <tbody>
                        @if(Session::has("Cart") !=null)
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
                            <td class="cart-pic first-row"><img with="100px" src="{{ asset('public/images/product/'.$hinh)}}" alt="{{$hinh}}"></td>
                            <td class="cart-title first-row">
                                <h5>{{$item['productinfo']->name}}</h5>
                            </td>
                            <td class="p-price first-row">{{number_format($item['productinfo']->price_buy)}} đ</td>
                            <td class="qua-col first-row">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="{{$item['qty']}}">
                                    </div>
                                </div>
                            </td>
                            <td class="total-price first-row">{{number_format($item['price_buy'])}} đ</td>
                            <td class="close-td first-row"><i class="ti-save"></i></td>
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
                        <ul>
                            <li class="subtotal">Tổng số lượng <span>{{Session::get("Cart")->totalqty}}</span></li>
                            <li class="cart-total">Thành tiền <span>{{number_format(Session::get("Cart")->totalprice_buy)}} đ</span></li>
                        </ul>
                        <a href="#" class="proceed-btn">PROCEED TO CHECK OUT</a>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->	
@endsection
