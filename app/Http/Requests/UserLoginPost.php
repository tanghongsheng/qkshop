<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginPost extends FormRequest
{
    /**
     * @var mixed
     */
    private $code;
    /**
     * @var mixed
     */
    private $password;
    /**
     * @var mixed
     */
    private $user_name;

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
            'user_name' => 'required_without:email',
            'email' => 'required_without:user_name',
            'password' => 'required',
            'code' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'user_name.required'      =>'用户名必须填写',
            'email.required'      =>'邮箱必须填写!',
            'code.required' => '验证码必须填写',
            'password.required'      =>'密码必须填写!',
        ];
    }

}
