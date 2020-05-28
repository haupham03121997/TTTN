<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class loginform extends FormRequest
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
            'admin_email'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'admin_email.required' =>'Tên đăng nhập phải là email'
        ];
    }
}
