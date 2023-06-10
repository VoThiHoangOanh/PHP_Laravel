@extends('layouts.admin')
@section('title', 'Chi tiết đơn hàng')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
           <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6 text-right">
          

                <a href="{{ route('order.index') }}" class="btn btn-info btn-sm"><i class="fas fa-reply"></i> Quay về danh sách</a>
            </div>
           </div>
          </div>

          <div class="card-body">
            <div class="col-sm-6 text-center">
              <h3>THÔNG TIN KHÁCH HÀNG</h3>
            </div>
              <table class="table table-bordered col-sm-6 ">
                <tr>
                  <th>Tên trường</th>
                  <th>Giá trị</th>
                </tr>

                <tr>
                  <td>ID</td>
                  <td>{{$order->id}}</td>
                </tr>

                <tr>
                  <td>Tên</td>
                  <td>{{$order->name}}</td>
                </tr>

                <tr>
                  <td>Email</td>
                  <td>{{$order->email}}</td>
                </tr>

                
                <tr>
                  <td>Điện thoại</td>
                  <td>{{$order->phone}}</td>
                </tr>
                <tr>
                  <td>Địa chỉ</td>
                  <td>{{$order->address}}</td>
                </tr>

               
              </table>
           
          </div>

          <div class="card-body">
            <div class="col-sm-12 text-center">
              <h3>CHI TIẾT ĐƠN HÀNG</h3>
            </div>
            <table class="table table-bordered">

              <thead>
                  <tr>
                    
                      <th style="width:20px;" class="text-center">
                          #
                      </th>
                      <th style="width:100px;">
                         Hình ảnh 
                      </th>
                      <th style="width:200px;">
                        Tên sản phẩm
                    </th>
                      <th style="width:100px;">
                          Giá tiền
                      </th>
                      <th style="width:100px;">
                          Số lượng
                      </th>
                      <th style="width:100px;">
                          Thành tiền
                      </th>

                      <th style="width:20px;" class="text-center">
                          ID
                      </th>
                      
                      
                  </tr>
                  
              </thead>
              <tbody>
              @php
                $tongtien=0;
              @endphp
              @foreach ($list_orderdetail as $orderdetail)
              @php
                $thanhtien= $orderdetail->qty*$orderdetail->price;
                $tongtien+=$thanhtien;
                  $product_image= $orderdetail->productimg;
                  if(count($product_image)>0)
                  $hinh="";
                  {
                      $hinh=$product_image[0]["image"];
                  }   
                  $product_name=$orderdetail->productdetail["name"];

              @endphp

             
                  <tr>
                      <td class="text-center"><input type="checkbox"></td>
                      <td><img class="img-fluid" style="width:70px;" src="{{ asset('public/images/product/'.$hinh)}}" alt="{{$hinh}}"></td>
                      <td>{{$product_name}}</td>

                      <td>{{number_format($orderdetail->price ,0,','.',')}} đ</td>
                      <td>{{ $orderdetail->qty }}</td>
                      <td>{{number_format($orderdetail->amount ,0,','.',')}} đ</td>
                      <td class="text-center">{{ $orderdetail->id }}</td>
                  </tr>
               @endforeach  
               
              </tbody>
            </table>
           
              <tr>
                <h4><td class=""> Tổng tiền: {{number_format($tongtien ,0,','.',')}}  đ</td></h4>
              </tr>
            
          </div>

          <!-- /.card-body -->
          <div class="card-footer">
            Footer
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
  
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  

  
  @endsection
