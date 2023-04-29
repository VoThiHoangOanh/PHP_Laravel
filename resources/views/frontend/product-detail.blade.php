@extends('layouts.site')

@section('title', $product->name)
@section('header')
    <link href="{{asset('public/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">  
    <link href="{{asset('public/owlcarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">  
@endsection
@section('footer')
<script src="{{asset('public/owlcarousel/owl.carousel.min.js')}}"></script>
@endsection

@section('content')
@php
    $product_image = $product->productimg;
    $hinh="";
    if(count($product_image)>0)
        {
            $hinh = $product_image[0]["image"];
        }
              
 @endphp
<div class="container my-4">
  <div class="row ">
    <div class="col-md-6">
        <div class="hinhlon">
        <img class="img-fluid w-100" src="{{ asset('public/images/product/'. $hinh)}}" alt="{{ $hinh }}" />
        </div>
        @if(count($product_image)>1)
        <div class="row">
            @for($i = 1; $i < count($product_image)-1; $i++)
            @php
                $hinh = $product_image[$i]["image"];   
            @endphp
            <div class="col-md-3">
                <img class="img-fluid w-100" src="{{ asset('public/images/product/'. $hinh)}}" alt="{{ $hinh }}" />
            </div>
            @endfor
        </div>
        @endif
    </div>
  <div class="col-md-6 "></div>
    <h1>{{$product->name}}</h1>
    <p>{{$product->metadesc}}</p>
    <div class="mb-3">
      <var class="price h1">{{$product->price_buy}} <sup>đ</sup></var>
    </div>
    <dl class="row-md-6">
      <dt class="col-mb-3">Thời gian giao hàng</dt>
      <dd class="col-mb-2">3-4 ngày</dd>
      <dt class="col-mb-6">
        7 ngày miễn phí trả hàng
      </dt>
      <dt class="col-mb-6">
        Hàng chính hãng 100%
      </dt>
    </dl>
    <div class="form-row  md-4">
      <div class="form-group col-md flex-grow-0">
        <div class="input-group mb-3 input-spinner">
            <input type="text" id="ipQuantity" class="form-control" value="1">
        </div>
      </div> <!-- col.// -->
      <div class="form-group col-md">
        <a href="#" id="addtocart" class="btn  btn-primary">
          <i class="fa fa-shopping-cart"></i>
            <span class="text">
              Thêm vào giỏ hàng
            </span>
        </a>
      </div> <!-- col.// -->
             
    </div>
  </div>
  <div class ="my-4">
  <div class="row">
    <div class="col-md-8">
      <h5 class="title-description">Chi tiết sản phẩm</h5>
      <p>{!! $product->detail !!}</p>
    </div> <!-- col.// -->
    <aside class="col-md-4">
      <div class="box">
        <h5 class="title-description">Dịch vụ & Khuyến mãi</h5>
          <p>
            Giá cả hợp lý nhất.<br />
            Đa dạng về mẫu mã, chủng loại.<br />
            Giao hàng nhanh chóng, tiện lợi.<br />
            Nếu sản phẩm hết hàng, Vui lòng liên hệ ngay với chúng tôi.<br />
          </p>
        <h5 class="title-description">Dịch vụ của chúng tôi</h5>
          <article class="media mb-3">
            <div class="media-body">
              <h6 class="mt-0"><a href="#">Hình thức vận chuyển</a></h6>
              <p class="icontext"><i class="icon text-success fa fa-truck"></i> Giao hàng nhanh trong vòng 3-4 ngày</p>
             </div>
          </article>
          <article class="media mb-3">
            <div class="media-body">
              <h6 class="mt-0"><a href="#"></a> Hàng chính hãng</h6>
              <p>Cam kết nếu hình không đúng thực tế , bạn nhận ngay coupon mua hàng trị giá 2.000.000đ tại hệ thống siêu thị Big C.</p>
            </div>
          </article>
          <article class="media mb-3">
            <div class="media-body">
              <h6 class="mt-0"><a href="#">Thanh toán</a></h6>
              <p>Khách hàng có thể lựa chọn một hoặc nhiều hình thức thanh toán.</p>
            </div>
          </article>
        </div> <!-- box.// -->
      </aside> <!-- col.// -->
    </div>

  <!-- <h3>Chi tiết sản phẩm</h3>
  <p>{!! $product->detail !!}</p> -->
  </div>
  @if(count($product_list)>0)
  
    <div class="row text-center">
    <div class="owl-carousel owl-theme">
        @foreach ($product_list as $row)
        @php
        $product_image = $row->productimg;
        $hinh=null;
        if(count($product_image)>0)
        {
            $hinh = $product_image[0]["image"];
        }
        @endphp
      <div class="item">
      <div class="product-item">
        <div class="product-image">
            <a href="{{ route('frontend.slug',['slug'=>$row->slug]) }}">
            <img class="img-fluid w-100" src="{{ asset('public/images/product/'. $hinh)}}" alt="{{ $hinh }}" />
            </a>
        </div>
        <h3 class="product-name">
            <a href="{{ route('frontend.slug',['slug'=>$row->slug]) }}">
            {{$row->name}}
            </a>
        </h3>
        <div class="product-price">
          <div class="row">
            <div class="col-md-12">
            <strong>
                <span class="price">{{$row->price_buy}} VND </span>
                <del>{{$row->price_sale}}</del>
            </strong>
            </div>
            <div class="col-md-12 text-center">
              <a href="cart.html" class="btn btn-default add-to-cart">
                <i class="fa fa-shopping-cart" aria-hidden="true">

                </i>Thêm giỏ hàng</a>

            </div>
          </div>
        </div>
      </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
  @endif
  
</div>


@endsection


