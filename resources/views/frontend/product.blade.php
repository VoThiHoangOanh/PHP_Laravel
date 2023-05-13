@extends('layouts.site')
@section('title','tat ca san pham')
@section('header')
    <link href="{{ asset('public/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/owlcarousel/assets/owl.theme.default.min.css') }}" rel="stylesheet">
@endsection
@section('footer')
    <script src="{{ asset('public/owlcarousel/owl.carousel.min.js') }}"></script>
@endsection
@section('content')

<div class="section-product-category">
  <h2 class="text-center my-5 category-title">TẤT CẢ SẢN PHẨM </h2>
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
      <div class="product-item">
        <div class="product-image">
          <a href="{{ route('frontend.slug',['slug'=>$product->slug]) }}">
          <img src="{{ asset('public/images/product/'. $hinh)}}" alt="{{ $hinh }}" />
          </a>
        </div>
        <h3 class="product-name">
          <a href="{{ route('frontend.slug',['slug'=>$product->slug]) }}">
            {{$product->name}}
          </a>
        </h3>
        <div class="product-price">
          <div class="row">
            <div class="col-md-12">
              <strong>
                <span class="price">{{number_format($product->price_buy)}} VND</span>
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
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection