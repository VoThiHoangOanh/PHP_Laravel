@extends('layouts.site')
@section('title', 'SHOP QUẦN ÁO')
@section('header')
    <link href="{{asset('public/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">  
    <link href="{{asset('public/owlcarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">  
@endsection
@section('footer')
<script src="{{asset('public/owlcarousel/owl.carousel.min.js')}}"></script>
@endsection

@section('content')

@foreach ($list_category as $category)
<x-product-home :rowcat="$category"/>
@endforeach

@endsection


