<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email' => 'required',
            'password' => 'required|min:6',
        ];
    }
    public function messages()
    {
        return [

            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu chứa tối thiểu :min ký tự',
            'email.required' => 'Vui lòng nhập email',
        ];
    }
}
