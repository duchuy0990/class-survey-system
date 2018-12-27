<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class studentUpdateInfo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'msv' => 'required',
            'ho_ten' => 'required',
            'password' => 'required',
            'lop_khoa_hoc' => 'required',
            'email' => 'required',
        ];
    }

    public function messages() {
        return [
            'msv.required' => 'Trường msv không được bỏ trống',
            'ho_ten.required' => 'Trường họ tên không được bỏ trống',
            'password.required' => 'Trường mật khẩu không được bỏ trống',
            'lop_khoa_hoc.required' => 'Trường lớp khóa học không được bỏ trống',
            'email.required' => 'Trường email không được bỏ trống',
        ];
    }
}
