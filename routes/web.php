<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/user/aaa', 'Admin\User@aaa');




Route::group(['middleware' => ['admin_login']], function () {
    Route::get('/admin/login/shop_single/{id}', 'admin\login@shop_single');
    Route::get('/admin/login/index', 'admin\login@index');
    Route::post('/admin/login/cart_do', 'admin\login@cart_do');
    Route::get('/admin/login/cart', 'admin\login@cart');
    Route::get('/admin/login/tc', 'admin\login@tc');
    Route::get('/admin/login/order', 'admin\login@order');



});
Route::get('/admin/login/login', 'admin\login@login');
Route::post('/admin/login/login_do', 'admin\login@login_do');
Route::get('/admin/login/about', 'admin\login@about');
Route::get('/admin/login/register', 'admin\login@register');
Route::post('/admin/login/register_do', 'admin\login@register_do');



Route::get('/index/index/login', 'index\index@login');
Route::post('/index/index/login_do', 'index\index@login_do');
Route::get('/index/index/logins', 'index\index@logins');
Route::post('/index/index/logins_do', 'index\index@logins_do');





Route::group(['middleware' => ['index_index']], function () {
    Route::get('/index/index/loginss', 'index\index@loginss');
    Route::get('/index/index/hmd/{id}', 'index\index@hmd');
    Route::get('/index/index/hmd_do', 'index\index@hmd_do');
    Route::get('/index/index/hmd_dos/{id}', 'index\index@hmd_dos');
    Route::get('/index/index/quanxian', 'index\index@quanxian');
    Route::get('/index/index/index', 'index\index@index');
    Route::post('/index/index/index_do', 'index\index@index_do');
    Route::get('/index/index/ecaa', 'index\index@ecaa');
    Route::get('/index/index/update/{id}', 'index\index@update');
    Route::post('/index/index/update_do', 'index\index@update_do');
    Route::get('/index/index/delete/{id}', 'index\index@delete');
    Route::get('/index/index/tl', 'index\index@tl');
});


Route::get('/zho/user', 'zho\index@user');

Route::get('/zho/index', 'zho\index@index');
Route::post('/zho/insert', 'zho\index@insert');
Route::get('/zho/ecaa', 'zho\index@ecaa');
Route::get('/zho/delete/{id}', 'zho\index@delete');

Route::group(['middleware' => ['login']], function () {
    Route::get('/zho/update/{id}', 'zho\index@update');
    Route::post('/zho/update_do', 'zho\index@update_do');
});



Route::post('pay', 'PayController@do_pay');
Route::get('pays/{id}', 'PayController@do_pays');

Route::get('return_url', 'PayController@return_url');//同步
Route::get('notify_url', 'PayController@notify_url');//异步

