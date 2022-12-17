<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email|email',
            'password' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name 必填',
            'name.unique' => '已有相同的 Name',
            'email.required' => 'Email 必填',
            'email.unique' => '已有相同的 Email',
            'email.email' => 'Email 不符合格式',
            'password.required' => 'Password 必填',
        ];
    }
}
