<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'birthday' => 'required|date_format:Y-m-d|before:today',
            'phone' => 'numeric| digits_between:5,20',
            'email' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'image.image' => 'File tải lên phải là ảnh',
            'image.mimes' => 'File tải lên phải có các định dạng :values',
            'image.max' => 'File tải lên phải có kích thước bé hơn :max',
            'name.required' => 'Vui lòng nhập tên người dùng',
            'email.unique' => 'Email này đã bị sử dụng',
            'birthday.before' => 'Ngày sinh không hợp lệ',
            'birthday.date_format' => 'Ngày sinh không đúng định dạng',
            'birthday.required' => 'Vui lòng nhập ngày sinh',
            'phone.digits_between' => 'SĐT chứa số ký tự tối thiểu :min ký tự và tối đa :max ký tự',
            'phone.numeric' => 'SĐT phải chứa ký tự là số',
        ];
    }
}
