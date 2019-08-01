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



Route::get('/zho/login/index', 'zho\Login@index');
Route::get('/zho/login/select', 'zho\Login@select');
Route::get('/zho/login/update/{id}', 'zho\Login@update');
Route::post('/zho/login/insert', 'zho\Login@insert');



Route::get('/zho/login_1/login', 'zho\Login_1@login');
Route::post('/zho/login_1/login_do', 'zho\Login_1@login_do');

Route::group(['middleware' => ['login_1']], function(){
    Route::get('/zho/login_1/index', 'zho\Login_1@index');
    Route::post('/zho/login_1/index_do', 'zho\Login_1@index_do');
    Route::get('/zho/login_1/index_do_1', 'zho\Login_1@index_do_1');
    Route::get('/zho/login_1/index_do_2', 'zho\Login_1@index_do_2');
    Route::get('/zho/login_1/index_do_3', 'zho\Login_1@index_do_3');
    Route::post('/zho/login_1/index_do_1_do', 'zho\Login_1@index_do_1_do');
    Route::post('/zho/login_1/index_do_2_do', 'zho\Login_1@index_do_2_do');
    Route::post('/zho/login_1/index_do_3_do', 'zho\Login_1@index_do_3_do');
    Route::get('/zho/login_1/ecaa', 'zho\Login_1@ecaa');
    Route::get('/zho/login_1/ecaas', 'zho\Login_1@ecaas');
    Route::post('/zho/login_1/eca', 'zho\Login_1@eca');
    Route::get('/zho/login_1/ec', 'zho\Login_1@ec');
    Route::get('/zho/login_1/ea/{id}', 'zho\Login_1@ea');


});


Route::get('/zho/login_2/login', 'zho\Login_2@login');
Route::post('/zho/login_2/login_do', 'zho\Login_2@login_do');

Route::group(['middleware' => ['login_2']], function(){
    Route::post('/zho/login_2/index', 'zho\Login_2@index');
    Route::get('/zho/login_2/index_do', 'zho\Login_2@index_do');
    Route::get('/zho/login_2/index_do_do', 'zho\Login_2@index_do_do');
    Route::post('/zho/login_2/index_do_1', 'zho\Login_2@index_do_1');
    Route::get('/zho/login_2/index_do_2', 'zho\Login_2@index_do_2');
    Route::get('/zho/login_2/index_do_3', 'zho\Login_2@index_do_3');
    Route::post('/zho/login_2/index_do_2_do', 'zho\Login_2@index_do_2_do');
    Route::post('/zho/login_2/index_do_3_do', 'zho\Login_2@index_do_3_do');
    Route::get('/zho/login_2/ecaa', 'zho\Login_2@ecaa');
    Route::get('/zho/login_2/eca', 'zho\Login_2@eca');
    Route::get('/zho/login_2/delete/{id}', 'zho\Login_2@delete');
    Route::get('/zho/login_2/select/{id}', 'zho\Login_2@select');
    Route::get('/zho/login_2/select_do/{id}', 'zho\Login_2@select_do');

});


Route::get('/zho/login_3/index', 'zho\Login_3@index');
Route::post('/zho/login_3/index_do', 'zho\Login_3@index_do');
Route::get('/zho/login_3/ecaa', 'zho\Login_3@ecaa');
Route::get('/zho/login_3/ecaa_do/{id}', 'zho\Login_3@ecaa_do');
Route::post('/zho/login_3/ecaa_do_1', 'zho\Login_3@ecaa_do_1');
Route::get('/zho/login_3/login', 'zho\Login_3@login');
Route::get('/zho/login_3/login_do/{id}', 'zho\Login_3@login_do');
Route::post('/zho/login_3/login_do_1', 'zho\Login_3@login_do_1');
Route::get('/zho/login_3/login_do_2/{id}', 'zho\Login_3@login_do_2');
Route::get('/zho/login_3/ec/{id}', 'zho\Login_3@ec');


Route::get('/zho/login_4/login', 'zho\Login_4@login');
Route::post('/zho/login_4/login_do', 'zho\Login_4@login_do');

Route::group(['middleware' => ['login_4']], function(){
    Route::get('/zho/login_4/index', 'zho\Login_4@index');
    Route::get('/zho/login_4/index_1', 'zho\Login_4@index_1');
    Route::get('/zho/login_4/index_13', 'zho\Login_4@index_13');
    Route::get('/zho/login_4/index_11', 'zho\Login_4@index_11');
    Route::post('/zho/login_4/index_111', 'zho\Login_4@index_111');
    Route::get('/zho/login_4/index_12', 'zho\Login_4@index_12');
    Route::post('/zho/login_4/index_121', 'zho\Login_4@index_121');
    Route::get('/zho/login_4/asd', 'zho\Login_4@asd');
    Route::post('/zho/login_4/asd_do', 'zho\Login_4@asd_do');
    Route::get('/zho/login_4/index_2', 'zho\Login_4@index_2');
    Route::post('/zho/login_4/index_21', 'zho\Login_4@index_21');
    Route::get('/zho/login_4/index_22', 'zho\Login_4@index_22');
    Route::get('/zho/login_4/index_212/{id}', 'zho\Login_4@index_212');
    Route::get('/zho/login_4/index_3', 'zho\Login_4@index_3');

});


Route::get('/zho/login_5/login', 'zho\Login_5@login');
Route::post('/zho/login_5/login_do', 'zho\Login_5@login_do');
Route::group(['middleware' => ['login_5']], function(){
    Route::get('/zho/login_5/index', 'zho\Login_5@index');
    Route::get('/zho/login_5/index_1', 'zho\Login_5@index_1');
    Route::get('/zho/login_5/index_13', 'zho\Login_5@index_13');
    Route::get('/zho/login_5/index_11', 'zho\Login_5@index_11');
    Route::post('/zho/login_5/index_111', 'zho\Login_5@index_111');
    Route::get('/zho/login_5/index_12', 'zho\Login_5@index_12');
    Route::post('/zho/login_5/index_121', 'zho\Login_5@index_121');
    Route::get('/zho/login_5/index_2', 'zho\Login_5@index_2');
    Route::post('/zho/login_5/index_21', 'zho\Login_5@index_21');
    Route::get('/zho/login_5/index_22', 'zho\Login_5@index_22');

});


Route::get('/zho/login_6/index', 'zho\Login_6@index');


Route::get('/kao/index/login', 'kao\index@login');
Route::post('/kao/index/login_do', 'kao\index@login_do');

Route::group(['middleware' => ['kao']], function() {
    Route::get('/kao/index/index', 'kao\index@index');
    Route::post('/kao/index/index_do', 'kao\index@index_do');
    Route::get('/kao/index/index_1/{id}', 'kao\index@index_1');

});

Route::post('/wx/index/index/index', 'wx\index\index@index');

