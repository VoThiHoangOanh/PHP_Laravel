@extends('layouts.admin')
@section('title', 'Chi tiết danh mục sản phẩm')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CHI TIẾT DANH MỤC</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Chi tiết danh mục</li>
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
            <a href="{{ route('category.edit',['category'=>$category->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Sửa</a>
            <a href="{{ route('category.delete',['category'=>$category->id]) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Xoá </a>

                <a href="{{ route('category.index') }}" class="btn btn-info btn-sm"><i class="fas fa-trash"></i> Quay về danh sách</a>
            </div>
           </div>
          </div>
          <div class="card-body">
              <table class="table">
                <tr>
                  <th>Tên trường</th>
                  <th>Giá trị</th>
                </tr>

                <tr>
                  <td>ID</td>
                  <td>{{$category->id}}</td>
                </tr>

                <tr>
                  <td>Name</td>
                  <td>{{$category->name}}</td>
                </tr>

                <tr>
                  <td>Slug</td>
                  <td>{{$category->slug}}</td>
                </tr>

                <!-- <tr>
                  <td>Parent_id</td>
                  <td>{{$category->parent_id}}</td>
                </tr>

                <tr>
                  <td>Sort_order</td>
                  <td>{{$category->sort_order}}</td>
                </tr> -->
                <tr>
                  <td>Metakey</td>
                  <td>{{$category->metakey}}</td>
                </tr>
                <tr>
                  <td>Metadesc</td>
                  <td>{{$category->metadesc}}</td>
                </tr>

               
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
