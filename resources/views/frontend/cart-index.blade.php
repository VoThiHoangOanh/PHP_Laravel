@extends('layouts.site')
@section('title', 'Giỏ hàng')
@section('content')
@if($newcart !=null)
<p></p>
@endif
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
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th class="p-name">Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số Lượng</th>
                                    <th>Thành Tiền</th>
                                    <th>Delete</th>
									<th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td class="cart-pic first-row"><img style="width:100px" src="{{ asset('public/images/home/h33.jpg')}}" alt=""></td>
                                    <td class="cart-title first-row">
                                        <h5>Áo sơ mi</h5>
                                    </td>
                                    <td class="p-price first-row">$60.00</td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-price first-row">$60.00</td>
                                    <td class="close-td first-row"><i class="ti-close"></i></td>
									<td class="close-td first-row"><i class="ti-save"></i></td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 offset-lg-8">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Tổng <span>$240.00</span></li>
                                    <li class="cart-total">Thành tiền <span>$240.00</span></li>
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
