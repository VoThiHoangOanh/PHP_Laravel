@extends('layouts.admin')
@section('title', 'Thêm trang đơn')
@section('content')
<form action="{{route('page.store')}}" method="post" enctype="multipart/form-data">
  @csrf
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>THÊM TRANG ĐƠN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Thêm trang đơn</li>
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
                <a href="{{ route('page.index') }}" class="btn btn-info btn-sm"><i class="fas fa-reply"></i> Quay về danh sách</a>
            </div>
           </div>
          </div>
          <div class="card-body">
            @includeIf('backend.message_alert')
            <div class="row">
              <div class="col-md-9">
                <div class="mb-3">
                 <label for="title">Tên trang đơn</label> 
                 <input type="text" name="title" value="{{old('title')}}" id="title" class="form-control"
                  placeholder="Nhập tên trang đơn">
                  @if($errors->has('title'))
                  <div class="text-danger">
                    {{$errors->first('title')}}
                  </div>
                  @endif
                </div>

                <div class="mb-3">
                 <label for="metakey">Từ Khoá</label>
                 <textarea name="metakey" id="metakey" class="form-control"
                  placeholder="Từ khoá tìm kiếm">{{old('metakey')}}</textarea> 
                  @if($errors->has('metakey'))
                  <div class="text-danger">
                    {{$errors->first('metakey')}}
                  </div>
                  @endif
                </div>

                <div class="mb-3">
                 <label for="metadesc">Mô tả</label>
                 <textarea name="metadesc" id="metadesc" class="form-control"
                  placeholder="Nhập mô tả">{{old('metadesc')}}</textarea> 
                  @if($errors->has('metadesc'))
                  <div class="text-danger">
                    {{$errors->first('metadesc')}}
                  </div>
                  @endif
                  <script>
                    CKEDITOR.replace("metadesc")
                  </script>
                </div>
                <div class="mb-3">
                 <label for="detail">Nội dung</label>
                 <textarea name="detail" id="detail" class="form-control"
                  placeholder="Nhập mô tả">{{old('detail')}}</textarea> 
                  @if($errors->has('detail'))
                  <div class="text-danger">
                    {{$errors->first('detail')}}
                  </div>
                  @endif
                  <script>
                    CKEDITOR.replace("detail")
                  </script>
                </div>


              </div>
              <div class="col-md-3">

                <div class="mb-3">
                 <label for="images">Hình đại diện</label> 
                 <input type="file" name="images" value="{{ old('images')}}" id="images" class="form-control">
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
