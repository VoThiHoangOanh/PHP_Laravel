<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'password' =>'required'
 
         ];
     }
 
     public function messages(): array
     {
         return [
            'name.required'=>'Bạn chưa nhập tên',
            'username.required'=>'Bạn chưa nhập tên tài khoản',
            'email.required'=>'Bạn chưa nhập email',
            'phone.required'=>'Chưa nhập số điện thoại',
            'password.required'=>'Chưa nhập mật khẩu'
 
         ];
     }
 }
