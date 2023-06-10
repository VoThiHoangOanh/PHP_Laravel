@extends('layouts.site')
@section('title', $row_brand->name)

@section('content')

<div class="container my-4">
  <div class="row ">
    <div class="col-md-3">
      <x-category-list/>
      <x-brand-list/>
    
    </div>
    <div class="col-md-9">
      <div class="section-product-category">
        <h2 class="title text-center" class="btn-default">
          {{$row_brand->name}}
        </h2>
        <div class="row text-center">
        @foreach ($product_list as $product)

            @php
              $product_image = $product->productimg;
              $hinh=null;
              if(count($product_image)>0)
              {
                $hinh = $product_image[0]["image"];
              }
              
            @endphp
            <div class="col-md-4 mb-6">
            <div class="product-item">
              <div class="product-image">
                <a href="{{ route('frontend.slug',['slug'=>$product->slug]) }}">
                <img class="img-fluid w-100" src="{{ asset('public/images/product/'. $hinh)}}" alt="{{ $hinh }}" />
                </a>
              </div>
              </br>
              <h4 class="product-name">
                <a href="{{ route('frontend.slug',['slug'=>$product->slug]) }}" class="btn-default">
                  {{$product->name}}
                </a>
              </h4>
              <div class="product-price">
                <div class="row">
                  <div class="col-md-12">
                  <strong>
                  <span class="price">{{number_format($product->price_buy)}} VND</span>
                    <del>{{$product->price_sale}}</del>
                  </strong>
                  </div>
                  <div class="col-md-12 text-center">
                    <a onclick="AddCart({{$product->id}})" href="javascript:" href="cart.html" class="btn btn-default add-to-cart">
                      <i class="fa fa-shopping-cart" aria-hidden="true">

                      </i>Thêm giỏ hàng</a>

                  </div>
                </div>
              </div>
            </div>
            </div>
            @endforeach
        </div>
        <div>
        {{ $product_list->links() }}
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
