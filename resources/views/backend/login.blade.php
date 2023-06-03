<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dist/css/adminlte.min.css') }}">
</head>
<body>
    <section class="section-conten padding-y" style="min-height:84vh">
        <div class="card mx-auto" style="max-width: 400px; margin-top:100px;">
            <div class="card-body">
                <h3 class="login-box-msg">ĐĂNG NHẬP</h3>
                <form action="{{route('postlogin')}}" method="post" accept-charset="utf-8">
                @csrf
                    <div class="social-auth-links text-center mt-2 mb-3">
                        <a href="#" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i> Đăng nhập bằng Facebook
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i> Đăng nhập bằng Google+
                        </a>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" placeholder="Username" name="username" class="form-control">
                            @if($errors->has('username'))
                                <div class="text-danger">
                                    {{$errors->first('username')}}
                                </div>
                            @endif
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" placeholder="Password" name="password" class="form-control">
                            @if($errors->has('password'))
                                <div class="text-danger">
                                    {{$errors->first('password')}}
                                </div>
                            @endif
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>                
                    <div class="form-group">
                        <a href="#" class="float-right">Quên mật khẩu?</a> 
                            <label class="float-left custom-control custom-checkbox"> 
                                <input type="checkbox" class="custom-control-input" checked=""> 
                                <div class="custom-control-label"> Nhớ mật khẩu </div> 
                            </label>
                    </div> 
                                        
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"> Đăng nhập  </button>
                    </div>  
                </form>
            </div> 
        </div> 

        <p class="text-center mt-4">Không có tài khoản? <a href="#">Đăng ký</a></p>
        <br><br>
    </section>
    <script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
