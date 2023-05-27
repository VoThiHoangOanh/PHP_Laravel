@extends('layouts.admin')
@section('title', 'Xoá Slider')
@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>XOÁ SLIDER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Xoá Slider</li>
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
            <a href="{{ route('slider.index') }}" class="btn btn-info btn-sm"><i class="fas fa-reply"></i> Quay về danh sách</a>

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
                    <th style="width:250px;">
                        Tên danh mục
                        <th>
                       Liên kết
                    </th>
                    <th style="width:160px;" class="text-center">
                       Vị trí
                    </th>
                    <!-- <th style="width:160px;" class="text-center">
                       Ngày đăng
                    </th> -->
                    <th style="width:200px;" class="text-center">
                        Chức năng
                    </th>
                    <th style="width:20px;" class="text-center">
                        ID
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($list_slider as $slider)
                <tr>
                    <td class="text-center"><input type="checkbox"></td>

                    <td>
                    <img class="img-fluid" src="{{ asset('public/images/slider/'.$slider->image)}}" alt="{{$slider->image}}">
                    </td>

                    <td>{{ $slider->name }}</td>
                   
                    <td>{{ $slider->link }}</td>
                    <td class="text-center">{{ $slider->position }}</td>

                    <td class="text-center">
                    
                       <a href="{{ route('slider.restore',['slider'=>$slider->id]) }}" 
                            class="btn btn-sm btn-success">
                            <i class="fas fa-undo-alt"></i>
                        </a> 
                       <a href="{{ route('slider.destroy',['slider'=>$slider->id]) }}"
                            class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a> 

                    </td>
                    <td class="text-center">{{ $slider->id }}</td>
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
