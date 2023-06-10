@extends('layouts.admin')
@section('title', 'Tất cả đơn hàng')
@section('content')

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
          <div class="card-body">
            @includeIf('backend.message_alert')
            <table class="table table-bordered">

              <thead>
                  <tr>
                    
                      <th style="width:20px;" class="text-center">
                          #
                      </th>
                      <th style="width:100px;">
                          Họ tên 
                      </th>
                      <th style="width:100px;">
                          Email
                      </th>
                      <th style="width:100px;">
                          Điện thoại
                      </th>

                      <th style="width:150px;" class="text-center">
                        Ngày tạo
                      </th>
                      <th style="width:150px;" class="text-center">
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
                      <td>{{ $order->name }}</td>
                    
                      <td>{{ $order->email }}</td>
                      <td>{{ $order->phone }}</td>
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

                        <a href="{{ route('order.show',['order'=>$order->id]) }}" 
                              class="btn btn-sm btn-info">
                              <i class="fas fa-eye">Xem</i>
                          </a> 

                      </td>
                      <td class="text-center">{{ $order->id }}</td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <div>
        {{ $list_order->links() }}
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
