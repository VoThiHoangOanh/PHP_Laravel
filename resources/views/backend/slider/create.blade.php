@extends('layouts.admin')
@section('title', 'Thêm Slider')
@section('content')
<form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
  @csrf
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>THÊM SLIDER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Thêm Slider</li>
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
                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Lưu[Thêm]</button>
                <a href="{{ route('slider.index') }}" class="btn btn-info btn-sm"><i class="fas fa-reply"></i> Quay về danh sách</a>
            </div>
           </div>
          </div>
          <div class="card-body">
            @includeIf('backend.message_alert')
            <div class="row">
              <div class="col-md-9">
                <div class="mb-3">
                 <label for="name">Tên slider</label> 
                 <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control"
                  placeholder="Nhập tên slider">
                  @if($errors->has('name'))
                  <div class="text-danger">
                    {{$errors->first('name')}}
                  </div>
                  @endif
                </div>

                <div class="mb-3">
                 <label for="link">Liên kết</label> 
                 <input type="text" name="link" value="{{old('link')}}" 
                 id="name" class="form-control"
                  placeholder="Nhập link">
                  @if($errors->has('link'))
                  <div class="text-danger">
                    {{$errors->first('link')}}
                  </div>
                  @endif
                </div>

                <div class="mb-3">
                 <label for="position">Vị trí</label> 
                 <input type="text" name="position" value="{{old('position')}}" 
                 id="name" class="form-control"
                  placeholder="Nhập vị trí">
                  @if($errors->has('position'))
                  <div class="text-danger">
                    {{$errors->first('position')}}
                  </div>
                  @endif
                </div>


                
              </div>
              <div class="col-md-3">

                <div class="mb-3">
                 <label for="sort_order">Vị trí sắp xếp</label> 
                 <select class="form-control" name="sort_order" id="sort_order">
                  <option value="0">--Vị trí sắp xếp--</option>
                  {!! $html_sort_order !!}
                 </select>
                </div>

                <div class="mb-3">
                 <label for="image">Hình đại diện</label> 
                 <input type="file" name="image" value="{{ old('image')}}" id="image" class="form-control">
                </div>

                
                <div class="mb-3">
                 <label for="status">Trạng thái</label> 
                 <select class="form-control" name="status" id="status">
                  <option value="1">Xuất bản</option>
                  <option value="2">Chưa xuất bản</option>
                  
                 </select>
                </div>

              </div>

            </div>
           
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
  


</form>

  
  @endsection
