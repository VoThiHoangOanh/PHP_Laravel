<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/css/responsive.css')}}" rel="stylesheet"> 
</head>
<body>
    <form action="{{route('postlogin')}}" method="post" accept-charset="utf-8">
    @csrf
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                ĐĂNG NHẬP
            </div>
            
            
            <div class="form-group">
                <input type="text" name="username" class="form-control">
                @if($errors->has('username'))
                    <div class="text-danger">
                        {{$errors->first('username')}}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control">
                @if($errors->has('password'))
                    <div class="text-danger">
                        {{$errors->first('password')}}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <a href="#" class="float-right">Quên mật khẩu?</a>
                <a href="#" class="float-right">Nhớ mật khẩu</a>
            </div> <!-- form-group form-check .// -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block"> Đăng nhập  </button>
            </div> <!-- form-group// -->

                    
            
          
        </div>
    </div>

</form>
<script src="{{asset('public/js/jquery.js')}}"></script>
<script src="{{asset('public/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('public/js/price-range.js')}}"></script>
<script src="{{asset('public/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('public/js/main.js')}}"></script>
<script src="{{asset('public/js/jquery-1.12.4.js')}}" type="text/javascript"></script>
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
</body>
</html>
