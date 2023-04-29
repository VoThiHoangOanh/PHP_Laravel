<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
  function getlogin()
  {
    return view('backend.login');

  }
  function postlogin(LoginRequest $request)
  { 
    $username = $request->username;
    $password = $request->password;
    $data = ['username' => $username, 'password' => $password];
    if (Auth::attempt($data))
      {
        // echo 'Thanh cong';
        // echo bcrypt($password);
        return redirect()->route('admin.dashboard')->with('message', ['type' => 'success', 'msg' => 'Đăng nhập tài khoản thành công!']);
      } 
      else
      {
          return redirect('login');
          // echo 'That bai';
          // var_dump($data);
          // echo bcrypt($password);
      }
  }
  function logout()
  {
    Auth::logout();
    return redirect('login');
  }
}
