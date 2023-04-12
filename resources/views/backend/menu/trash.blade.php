@extends('layouts.admin')
@section('title', 'Tất cả Menu')
@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>XOÁ MENU</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Xoá Menu</li>
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
            <a href="{{ route('menu.index') }}" class="btn btn-info btn-sm"><i class="fas fa-trash"></i> Quay về danh sách</a>

            </div>
           </div>
          </div>
          <div class="card-body">
            @includeIf('backend.message_alert')
            <table class="table table-bordered">

            <thead>
            <tr>
                          <th style="width:20px;" class="text-center">#</th>
                          <th style="width:200px;"class="text-center">Tên Menu</th>
                          <th  style="width:160px;"class="text-center">Liên kết</th>
                          <th style="width:120px;" class="text-center">Vị trí</th>
                          <th style="width:200px;" class="text-center"> Chức năng</th>
                          <th style="width:20px;" class="text-center">ID </th>
                    
                      </tr>
            </thead>
            <tbody>
            @foreach ($list_menu as $menu)
                <tr>
                    <td class="text-center"><input type="checkbox"></td>
                    <td>{{ $menu->name }}</td>
                   
                    <td>{{ $menu->link }}</td>
                    <td class="text-center">{{ $menu->position }}</td>

                    <td class="text-center">
                    @if($menu->status==1)
                    <a href="{{ route('menu.status',['menu'=>$menu->id]) }}"
                            class="btn btn-sm btn-success">
                            <i class="fas fa-toggle-on"></i>
                    </a>
                    @else
                    <a href="{{ route('menu.status',['menu'=>$menu->id]) }}"
                            class="btn btn-sm btn-danger">
                            <i class="fas fa-toggle-off"></i>
                    </a>
                    @endif

                       <a href="{{ route('menu.edit',['menu'=>$menu->id]) }}"
                            class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i>
                        </a> 
                       <a href="{{ route('menu.show',['menu'=>$menu->id]) }}" 
                            class="btn btn-sm btn-success">
                            <i class="fas fa-eye"></i>
                        </a> 
                       <a href="{{ route('menu.destroy',['menu'=>$menu->id]) }}"
                            class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </a> 

                    </td>
                    <td class="text-center">{{ $menu->id }}</td>
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
