<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
           'title'=>'required|min:2',
           'metakey'=>'required',
           'metadesc'=>'required',
           'detail' =>'required'

        ];
    }

    public function messages(): array
    {
        return [
           'title.required'=>'Bạn chưa nhập tên',
           'title.min'=>'Tên ít nhất 2 ký tự',
           'detail.required'=>'Bạn chưa nhập nội dung',

           'metakey.required'=>'Chưa nhập từ khoá tìm kiếm',
           'metadesc.required'=>'Chưa nhập mô tả'

        ];
    }
}
