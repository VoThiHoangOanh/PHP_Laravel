@extends('layouts.site')
@section('title', $row_topic->name)

@section('content')

<div class="container my-4">
  <div class="row">
    <div class="col-md-3">
      <x-category-list/>
      <x-brand-list/>
    
    </div>
    <div class="col-md-9">
      <div class="section-post-topic">
        <h2 class="text-center category-title">
          {{$row_topic->name}}
        </h2>
        <div class="row text-center">
        @foreach ($post_list as $post)
            <div class="item col-md-6 mb-6">
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
                <div class="row text-center">
                  <div class="col-md-12 text-center">
                    <a href="{{ route('frontend.slug',['slug'=>$post->slug]) }}" class="btn btn-default add-to-cart">
                      <i class="fa fa-eye">
                      </i>Xem thêm</a>
                  </div>
                </div>
              </div>
            </div>
            </div>
            @endforeach
        </div>
        <div>
        {{ $post_list->links() }}
        </div>
      </div>
    </div>
  </div>
</div>


@endsection