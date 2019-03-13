<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->roles[0]->code == 'admin') {
            return true;
        }
        return false;
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
            'phone' => 'numeric| digits_between:5,20',
            'permission' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên người dùng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu chứa tối thiểu :min ký tự',
            'confirm_password.required' => 'Vui lòng xác nhận mật khẩu',
            'confirm_password.same' => 'Mật khẩu xác nhận không chính xác',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email này đã bị sử dụng',
            'birthday.before' => 'Ngày sinh không hợp lệ',
            'birthday.date_format' => 'Ngày sinh không đúng định dạng',
            'birthday.required' => 'Vui lòng nhập ngày sinh',
            'phone.digits_between' => 'SĐT chứa số ký tự tối thiểu :min ký tự và tối đa :max ký tự',
            'phone.numeric' => 'SĐT phải chứa ký tự là số',
            'permission.required' => 'Cần chọn ít nhất một vai trò',
        ];
    }
}
