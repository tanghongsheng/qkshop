<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $res = array();


        if (!$request->session()->has('user.user_id'))
        {
            $res['code'] = -1;

            $res['result'] = '会员登录过期,请重新登录';

            return response()->json($res,422);
        }


        return $next($request);
    }
}
