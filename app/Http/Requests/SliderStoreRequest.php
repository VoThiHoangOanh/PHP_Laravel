<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderStoreRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
           'name'=>'required',
           'link'=>'required',
           'position'=>'required'

        ];
    }

    public function messages(): array
    {
        return [
           'name.required'=>'Bạn chưa nhập tên',
           'link.required'=>'Chưa nhập link',
           'position.required'=>'Chưa nhập vị trí'

        ];
    }
}
