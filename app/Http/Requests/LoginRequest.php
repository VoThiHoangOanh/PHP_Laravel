<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class LoginRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'username'=>'required',
            'password' =>'required'
 
         ];
     }
 
     public function messages(): array
     {
         return [
            'username.required'=>'Bạn chưa nhập tên tài khoản',
            'password.required'=>'Chưa nhập mật khẩu'
 
         ];
     }
 }
