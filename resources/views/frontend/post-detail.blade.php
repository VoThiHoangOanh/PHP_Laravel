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
    <div class="col-md-9">
      <div class="post_item">
        <h1>{{$post->title}}</h1>
        @php
          $date=!empty($post->updated_at) ? (new DateTime($post->updated_at))->format('H:i d/m/Y') : "";
        @endphp
        <p>Ngày đăng: {{$date}}</p>
      </div>
      <p>{{ $post->metadesc }}</p>
      <p>{{ $post->detail }}</p>
      <div class="my-4">
        <img class="img-fluid" src="{{ asset('public/images/post/'.$post->images)}}" alt="{{$post->images}}">      
      </div>
    </div>
    <div class ="col-md-3">
        <x-category-list/>
        <x-brand-list/>
    </div>
  </div>
</div>


@endsection


