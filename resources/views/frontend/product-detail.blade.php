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
    <h1>{{$product->price_buy}} đ</h1>
  </div>
  <div class ="my-4">
  <h3>Chi tiết sản phẩm</h3>
  <p>{!! $product->detail !!}</p>
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


