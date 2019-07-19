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
    Route::get('/admin/login/shop_single/{id}', 'admin\Login@shop_single');
    Route::get('/admin/login/index', 'admin\Login@index');
    Route::post('/admin/login/cart_do', 'admin\Login@cart_do');
    Route::get('/admin/login/cart', 'admin\Login@cart');
    Route::get('/admin/login/tc', 'admin\Login@tc');
    Route::get('/admin/login/order', 'admin\Login@order');



});
Route::get('/admin/login/login', 'admin\Login@login');
Route::post('/admin/login/login_do', 'admin\Login@login_do');
Route::get('/admin/login/about', 'admin\Login@about');
Route::get('/admin/login/register', 'admin\Login@register');
Route::post('/admin/login/register_do', 'admin\Login@register_do');



Route::get('/index/index/login', 'index\Index@login');
Route::post('/index/index/login_do', 'index\Index@login_do');
Route::get('/index/index/logins', 'index\Index@logins');
Route::post('/index/index/logins_do', 'index\Index@logins_do');





Route::group(['middleware' => ['index_index']], function () {
    Route::get('/index/index/loginss', 'index\Index@loginss');
    Route::get('/index/index/hmd/{id}', 'index\Index@hmd');
    Route::get('/index/index/hmd_do', 'index\Index@hmd_do');
    Route::get('/index/index/hmd_dos/{id}', 'index\Index@hmd_dos');
    Route::get('/index/index/quanxian', 'index\Index@quanxian');
    Route::get('/index/index/index', 'index\Index@index');
    Route::post('/index/index/index_do', 'index\Index@index_do');
    Route::get('/index/index/ecaa', 'index\Index@ecaa');
    Route::get('/index/index/update/{id}', 'index\Index@update');
    Route::post('/index/index/update_do', 'index\Index@update_do');
    Route::get('/index/index/delete/{id}', 'index\Index@delete');
    Route::get('/index/index/tl', 'index\Index@tl');
});


Route::get('/zho/user', 'zho\Index@user');

Route::get('/zho/index', 'zho\Index@index');
Route::post('/zho/insert', 'zho\Index@insert');
Route::get('/zho/ecaa', 'zho\Index@ecaa');
Route::get('/zho/delete/{id}', 'zho\Index@delete');

Route::group(['middleware' => ['login']], function () {
    Route::get('/zho/update/{id}', 'zho\Index@update');
    Route::post('/zho/update_do', 'zho\Index@update_do');
});



Route::post('pay', 'PayController@do_pay');
Route::get('pays/{id}', 'PayController@do_pays');

Route::get('return_url', 'PayController@return_url');//同步
Route::get('notify_url', 'PayController@notify_url');//异步

