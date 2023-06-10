
<div class="section-product-category">
  <h2 class="title text-center" >
    <a href="{{ route('frontend.slug',['slug'=>$row_cat->slug]) }}" class=" btn-default" >{{$row_cat->name}}</a>
  </h2>
  <div class="row text-center">
    <div class="owl-carousel owl-theme">
      @foreach ($product_list as $product)

      @php
        $product_image = $product->productimg;
        $hinh=null;
        if(count($product_image)>0)
        {
          $hinh = $product_image[0]["image"];
        }
        
      @endphp
      <div class="item">
            <div class="product-image">
              <a href="{{ route('frontend.slug',['slug'=>$product->slug]) }}">
              <img src="{{ asset('public/images/product/'. $hinh)}}" alt="{{ $hinh }}" />
              </a>
            </div>
            </br>
            <h4 class="product-name">
              <a href="{{ route('frontend.slug',['slug'=>$product->slug]) }}" class=" btn-default">
                {{$product->name}}
              </a>
            </h4>
            <div class="product-price">
              <div class="row">
                <div class="col-md-12">
                  <strong>
                    <h5 class="price">{{number_format($product->price_buy)}} VND</h5>
                    <del>{{$product->price_sale}}</del>
                  </strong>
                </div>
                <div class="col-md-12 text-center">
                  <a onclick="AddCart({{$product->id}})" href="javascript:" class="btn btn-default add-to-cart">
                    <i class="fa fa-shopping-cart" aria-hidden="true">
                    </i>Thêm giỏ hàng</a>
                </div>
              </div>
            </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
