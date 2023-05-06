@if(Session::has("Cart") !=null)
<div class="select-items">
    <table>
        <tbody>
            @foreach(Session::get('Cart')->product as $item)
            
            <tr>
                <td class="si-pic"><img src="{{ asset('public/images/home/h33.jpg')}}" alt=""></td>
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
    <h5>{{number_format(Session::get('Cart')->totalprice_buy)}} đ</h5>
    <input hidden id="total-quanty-cart" type="number" value="Session::get('Cart')->totalqty}}">
</div>
 
@endif                               
