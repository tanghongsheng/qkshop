<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersPost extends FormRequest
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
     * @var mixed
     */
    private $user_name;
    /**
     * @var mixed
     */
    private $code;

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
            'user_name'=>'required|min:6|unique:ecs_users,user_name',
            'email'=>'required|email|unique:ecs_users,email',
            'code'=>'required',
            'password'=>'required|min:6'
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'user_name.required'      =>'用户名必须填写',
            'user_name.min'      =>'n用户名最小为六位!',
            'user_name.unique'      =>'该用户名已经存在,请更换',
            'email.required'      =>'邮箱必须填写!',
            'email.email'      =>'邮箱格式错误!',
            'email.unique'      =>'该邮箱已经存在,请更换!',
            'code.required' => '验证码必须填写',
            'password.required'      =>'密码必须填写!',
            'password.min'      =>'密码不得小于六位!'
        ];
    }

}
