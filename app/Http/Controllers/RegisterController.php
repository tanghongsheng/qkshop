<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\User;
use GuzzleHttp\Client as Guzzle;


class RegisterController extends Controller
{
    private $http;

    public function __construct(Guzzle $http)
    {
        $this->http = $http;
    }

    public function register(RegisterUserRequest $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        //返回授权信息
        $response = $this->http->post('http://www.laravel6.com/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'r8WtgSOyy07YIE7OvtUutGuTljVbd1g9qhEIEyXk',
                'username' => $user->email,
                'password' => $request->password,
                'scope' => '*',
            ],
        ]);

        $token = json_decode((string) $response->getBody(), true);

        return response()->json([
            'token'=>$token
        ],201);
    }

}

