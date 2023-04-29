@extends('layouts.site')
@section('title', $post->title)
@section('header')
    <link href="{{asset('public/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">  
    <link href="{{asset('public/owlcarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">  
@endsection
@section('footer')
<script src="{{asset('public/owlcarousel/owl.carousel.min.js')}}"></script>
@endsection

@section('content')

<div class="container my-4">
  <div class="row ">
    <div class="col-md-6">
        <img class="img-fluid" src="{{ asset('public/images/post/'.$post->images)}}" alt="{{$post->images}}">      
    </div>
  <div class="col-md-6 "></div>
    <h1>{{$post->title}}</h1>
    <p>{!! $post->metadesc !!}</p>
  </div>
  <div class ="my-4">
  <h3>Chi tiết bài viết</h3>
  <p>{!! $post->detail !!}</p>
  </div>
  @if(count($post_list)>0)
  
    <div class="row text-center">
    <div class="owl-carousel owl-theme">
      <div class="item">
      <div class="post-item">
        <div class="post-image">
            <a href="{{ route('frontend.slug',['slug'=>$post->slug]) }}">
              <img class="img-fluid" src="{{ asset('public/images/post/'.$post->images)}}" alt="{{$post->images}}">
            </a>
        </div>
        <h3 class="post-name">
          <a href="{{ route('frontend.slug',['slug'=>$post->slug]) }}">
            {{$post->title}}
          </a>
        </h3>
        <div class="post">
          <div class="row">
            <div class="col-md-12 text-center">
              <a href="#" class="btn btn-default add-to-cart">
                <i class="fa fa-eye">
                </i>Xem thêm</a>
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


