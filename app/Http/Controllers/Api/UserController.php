<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginPost;
use App\Http\Requests\UsersPost;
use App\Models\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $res = array();

    protected $status = 200;

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = Users::all();

        $res = array();

        $res['message'] = "登录成功";

        $res['user'] = $data;

        return response()->json($res);

    }

    /**
     * @param UsersPost $request
     * @param Users $users
     * @return JsonResponse
     */
    public function register(UsersPost $request,Users $users): JsonResponse
    {

        if ($request->session()->get('code') != $request->code)
        {

            $user = $users::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'sex' => 0,
                'birthday' =>'1961-01-01',
                'pay_points'=>0,
                'rank_points'=>0,
                'address_id'=>0,
                'reg_time'=>time(),
                'last_login'=>time(),
                'last_time'=>date('Y-m-d H:i:s',time()),
                'user_rank'=>0,
                'is_special'=>0,
                'flag'=>0,
                'is_validated'=>0,
                'credit_line'=>0,
                'aite_id'=>0,
                'surplus_password'=>0,
                'alias'=>0,
                'msn'=>0,
                'qq'=>0,
                'home_phone'=>0,
                'office_phone'=>0,
                'mobile_phone'=>$request->user_name,
                'validated'=>0,
                'is_fenxiao'=>0,
                'real_name'=>'',
                'card'=>'',
                'face_card'=>'',
                'back_card'=>'',
                'country'=>0,
                'province'=>0,
                'city'=>0,
                'district'=>0,
                'address'=>0,
                'status'=>0,
                'mediaID'=>0,
                'mediaUID'=>0,
                'headimg'=>0,
            ]);

            $request->session()->put('user.user_id',$user->user_id);

            $request->session()->put('user.user_name',$user->user_name);

            $request->session()->put('user.user_rank',0);

            $this->res['code'] = '1';

            $this->res['message'] = '注册成功';

        }else{

            $this->res['code'] = '0';

            $this->res['message'] = '验证码验证失败,请重新获取';
        }

        return response()->json($this->res);

    }

    /**
     * 登录
     * @param UserLoginPost $request
     * @return JsonResponse
     */
    public function login(UserLoginPost $request): JsonResponse
    {

        //对接手机验证码后更换
        if ($request->session()->get('code') != $request->code)
        {

            $password = $request->password;

            $user_msg = Users::where('user_name',$request->user_name)->first();

            if (password_verify($password,$user_msg->password))
            {

                $request->session()->put('user.user_id',$user_msg->user_id);

                $request->session()->put('user.user_name',$user_msg->user_name);

                $request->session()->put('user.user_rank',$user_msg->user_rank);

                $this->res['code'] = '1';

                $this->res['message'] = '登录成功';

            }else{
                $this->res['code'] = 0;
                $this->res['msg'] = '密码错误';
            }

        }else{

            $this->res['code'] = '0';

            $this->res['message'] = '验证码验证失败,请重新获取';

            $this->status = 422;

        }

        return response()->json($this->res,$this->status);
    }

    /**
     * 注销登录
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->session()->flush();

        $this->res['code'] = 1;

        $this->res['message'] = '退出登录成功';

        return response()->json($this->res,$this->status);
    }


}
