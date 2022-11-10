<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Updatenhan_hieuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
      public function rules()
    {
        return [
            'ten_nhan_hieu' => 'required|unique:nhan_hieus,ten_nhan_hieu',
            'hinh_nhan_hieu' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

     public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'min' => ':attribute không được nhỏ hơn :min',
            'max' => ':attribute không được lớn hơn :max',
            'numeric' => ':attribute phải là số',
            'unique' => ':attribute đã tồn tại',
                //'Hinh.mimes' => 'Hình ảnh phải có định dạng jpeg,png,jpg,gif,svg',
        ];
    }

    public function attributes(){
        return [
            'ten_nhan_hieu' => 'Tên  nhãn hiệu',
            'hinh_nhan_hieu' => 'hình nhãn hiệu'
        ];
    }
}
