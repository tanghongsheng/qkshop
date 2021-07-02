<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RegisterUserRequest extends FormRequest
{
    /**
     * @var mixed
     */
    private $name;
    /**
     * @var mixed
     */
    private $email;
    /**
     * @var mixed
     */
    private $password;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'=>'required|min:6',
            'email'=>'required|email|unique:email',
            'password'=>'required|min:6'
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required'      =>'用户名必须填写',
            'name.min'      =>'n用户名最小为六位!',
            'email.required'      =>'邮箱必须填写!',
            'email.email'      =>'邮箱格式错误!',
            'email.unique'      =>'该邮箱已经存在,请更换!',
            'password.required'      =>'密码必须填写!',
            'password.min'      =>'密码不得小于六位!'
        ];
    }

}
