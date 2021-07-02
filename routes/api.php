<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();

//});

Route::post('/register','RegisterController@register');


/**
 * api接口
 */
Route::middleware('auth:api')->group(function ()
{

    Route::post('/user','Api\UserController@index');                    //获取用户信息
    Route::post('/user/register','Api\UserController@register');        //注册
    Route::post('/user/login','Api\UserController@login');              //登录
    Route::post('/user/logout','Api\UserController@logout');            //注销登录
    Route::post('/index','Api\IndexController@index');                  //获取首页信息
    Route::post('/index/header','Api\IndexController@header');                  //获取首页头部信息
    Route::post('/index/footer','Api\IndexController@footer');                  //获取首页尾部信息

    //需要登录验证的路由
    Route::group(['middleware' => 'CheckLogin'], function () {
        Route::post('/index/get_sidebar','Api\IndexController@get_sidebar');                  //获取首页尾部信息
    });



});




