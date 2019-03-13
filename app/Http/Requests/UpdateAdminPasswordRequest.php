<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAdminPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->role[0]->code == 'admin') {
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
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu chứa tối thiểu :min ký tự',
            'confirm_password.required' => 'Vui lòng xác nhận mật khẩu',
            'confirm_password.same' => 'Mật khẩu xác nhận không chính xác',
        ];
    }
}
