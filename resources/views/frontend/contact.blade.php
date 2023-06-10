@extends('layouts.site')
@section('title', 'Lien he')
@section('content')

<div class="container back">
    <div class="row">
        <div class="col-md-6">
            <h5>NƠI GIẢI ĐÁP TOÀN BỘ MỌI THẮC MẮC CỦA BẠN?</h5>
            <p>Với sứ mệnh "Khách hàng là ưu tiên số 1" chúng tôi luôn mạng lại giá trị tốt nhất</p>
            <div class="row">
                <div class="col-md-12">
                    <p><b>Số điện thoại:</b> 0393051524</p>
                    <p><b>Email:</b> vothihoangoanh889@gmail.com</p>
                    <p><b>Địa chỉ:</b> 141/1/1,đường 339, Phước Long B, Quận 9</p>
                </div>
            </div>

            @includeIf('frontend.massage_alert')
            <form action="{{route('frontend.postcontact')}}" method="POST" role="form">
                <legend>LIÊN HỆ VỚI CHÚNG TÔI</legend>
                @csrf
                <div class="form-group ">
                    <label for="">Họ tên</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên">
                    @if ($errors->any())
                        {{ $errors->first('name') }} 
                    @endif
                </div>
                <div class="form-group my-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Nhập email">
                    @if ($errors->any())
                        {{ $errors->first('email') }} 
                    @endif
                </div>
                <div class="form-group my-3">
                    <label for="">Số điện thoại</label>
                    <input class="form-control" name="phone" placeholder="Nhập số điện thoại">
                    @if ($errors->any())
                        {{ $errors->first('phone') }} 
                    @endif
                </div>
                <div class="form-group my-3">
                    <label for="">Nội dung</label>
                    <textarea name="content" class="form-control" cols="20" rows="5"></textarea>
                    @if ($errors->any())
                        {{ $errors->first('content') }} 
                    @endif
                </div>
                <button type="submit" class="btn btn-primary my-3">Gửi đi</button>
            </form>
        </div>   
           
        <div class="col-md-6">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6590.536588029644!2d106.77368496678501!3d10.82993724816805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752701a34a5d5f%3A0x30056b2fdf668565!2zVHLGsOG7nW5nIENhbyDEkOG6s25nIEPDtG5nIFRoxrDGoW5nIFRQLkhDTQ!5e0!3m2!1svi!2s!4v1686039187392!5m2!1svi!2s" width="500" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>        </div>
        </div>
    </div>
</div>

     
@endsection