@extends('layouts.admin')
@section('title', 'Tất cả đơn hàng')
@section('content')

{{-- @php
    dd($list_order);
@endphp
 --}}

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TẤT CẢ ĐƠN HÀNG</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Tất cả đơn hàng</li>
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
                <button class="btn btn-sm btn-danger"type="submit"><i class="far fa-calendar-times"></i>Xoá</button>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('order.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Thêm</a>
                <a href="{{ route('order.trash') }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Thùng rác</a>
            </div>
           </div>
          </div>
          <div class="card-body">
            @includeIf('backend.message_alert')
            <table class="table table-bordered">

            <thead>
                <tr>
                  
                    <th style="width:20px;" class="text-center">
                        #
                    </th>
                    <th style="width:100px;" class="text-center">
                        Hình ảnh
                    </th>
                    <th style="width:200px;">
                        Tên danh mục
                    </th>
                   
                    <th>
                        Slug
                    </th>

                    <th style="width:260px;" class="text-center">
                       Ngày đăng
                    </th>
                    <th style="width:200px;" class="text-center">
                        Chức năng
                    </th>
                    <th style="width:20px;" class="text-center">
                        ID
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($list_order as $order)
                <tr>
                    <td class="text-center"><input type="checkbox"></td>

                    <td>
                    <img class="img-fluid" src="{{ asset('public/images/order/'.$order->image)}}" alt="{{$order->image}}">
                    </td>

                    <td>{{ $order->name }}</td>
                   
                    <td>{{ $order->slug }}</td>

                    <!-- <td>{{ $order->metadesc }}</td> -->

                    <td class="text-center">{{ $order->created_at }}</td>

                    <td class="text-center">
                    @if($order->status==1)
                    <a href="{{ route('order.status',['order'=>$order->id]) }}"
                            class="btn btn-sm btn-success">
                            <i class="fas fa-toggle-on"></i>
                    </a>
                    @else
                    <a href="{{ route('order.status',['order'=>$order->id]) }}"
                            class="btn btn-sm btn-danger">
                            <i class="fas fa-toggle-off"></i>
                    </a>
                    @endif

                       <a href="{{ route('order.edit',['order'=>$order->id]) }}"
                            class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i>
                        </a> 
                       <a href="{{ route('order.show',['order'=>$order->id]) }}" 
                            class="btn btn-sm btn-success">
                            <i class="fas fa-eye"></i>
                        </a> 
                       <a href="{{ route('order.delete',['order'=>$order->id]) }}"
                            class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a> 

                    </td>
                    <td class="text-center">{{ $order->id }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
