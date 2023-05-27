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
                <th class="close-td"><a href="{{route('frontend.home')}}" class="btn btn-info btn-sm">Mua thêm</a></th>
                <th class="close-td first-row edit-all" ><i class="ti-save"></i></th>
                <th class="close-td first-row del-all"><i class="ti-close"></i></th>
            </tr>
        </thead>
        <tbody>
            @if(Session::has("Cart") !=null)
            @foreach(Session::get('Cart')->products as $item)
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
                        <input data-id="{{$item['productinfo']->id}}" id="quanty-item-{{$item['productinfo']->id}}" type="text" value="{{$item['qty']}}">
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