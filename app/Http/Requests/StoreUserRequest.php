<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'email' => 'required|unique:users',
            'birthday' => 'required|date_format:Y-m-d|before:today',
            'phone' => 'numeric| min:5',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên người dùng',
            'password.required'  => 'Vui lòng nhập mật khẩu',
            'password.min'  => 'Mật khẩu chứa tối thiểu 6 ký tự',
            'confirm_password.required' => 'Vui lòng xác nhận mật khẩu',
            'confirm_password.same' => 'Mật khẩu xác nhận không chính xác',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email này đã bị sử dụng',
            'birthday.before' => 'Ngày sinh không hợp lệ',
            'birthday.date_format' => 'Ngày sinh không đúng định dạng',
            'birthday.requird' => 'Vui lòng nhập ngày sinh',
            'phone.min' => 'SĐT chứ tối thiểu 5 ký tự',
            'phone.numeric' => 'SĐT phải chứa ký tự là số',
        ];
    }
}
