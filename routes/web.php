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
    //    phpinfo();die;
    return view('welcome');
});
//Route::get('/user/aaa', 'Admin\User@aaa');




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


Route::get('/kao/index/login', 'kao\Index@login');
Route::post('/kao/index/login_do', 'kao\Index@login_do');

Route::group(['middleware' => ['kao']], function() {
    Route::get('/kao/index/index', 'kao\Index@index');
    Route::post('/kao/index/index_do', 'kao\Index@index_do');
    Route::get('/kao/index/index_1/{id}', 'kao\Index@index_1');

});

Route::post('/wx/index/index/index', 'wx\index\index@index');


Route::get('/wx/index/index_1/index', 'wx\index\index_1@index');
Route::get('/wx/index/index_1/index_1', 'wx\index\index_1@index_1');
Route::get('/wx/index/index_1/index_2', 'wx\index\index_1@index_2');
Route::get('/wx/index/index_1/index_3', 'wx\index\index_1@index_3');
Route::get('/wx/index/index_1/index_4/{id}', 'wx\index\index_1@index_4');


//微信授权注册登录
Route::get('/wx/index/index_1/login', 'wx\index\index_1@login');
Route::get('/wx/index/index_1/code', 'wx\index\index_1@code');
Route::get('/wx/index/index_1/code_1', 'wx\index\index_1@code_1');

//模板内容获取
Route::get('/wx/index/index_1/template_list', 'wx\index\index_1@template_list');


//模板删除
Route::get('/wx/index/index_1/del_temlate', 'wx\index\index_1@del_temlate');


//模板消息推送
Route::get('/wx/index/index_1/push_template', 'wx\index\index_1@push_template');


//图片  音频   视频  缩略图 上传素材
Route::get('/wx/index/index_1/index_5', 'wx\index\index_1@index_5');
Route::post('/wx/index/index_1/index_5_do', 'wx\index\index_1@index_5_do');

//获取临时素材
Route::get('/wx/index/index_1/get_source', 'wx\index\index_1@get_source');
Route::get('/wx/index/index_1/get_sources', 'wx\index\index_1@get_sources');

//获取临时视频素材
Route::get('/wx/index/index_1/get_video_source', 'wx\index\index_1@get_video_source');

//用户标签管理
Route::get('/wx/index/index_1/get_yonghu','wx\index\index_1@get_yonghu');
Route::post('/wx/index/index_1/post_yonghu','wx\index\index_1@post_yonghu');
Route::get('/wx/index/index_1/get_yonghu_do','wx\index\index_1@get_yonghu_do');
Route::get('/wx/index/index_1/yonghu_delete/{id}','wx\index\index_1@yonghu_delete');
Route::get('/wx/index/index_1/yonghu_insert/{id}','wx\index\index_1@yonghu_insert');
Route::get('/wx/index/index_1/yonghu_select/{id}','wx\index\index_1@yonghu_select');
Route::get('/wx/index/index_1/yonghu_update/{id}','wx\index\index_1@yonghu_update');
Route::post('/wx/index/index_1/yonghu_update_do','wx\index\index_1@yonghu_update_do');
Route::post('/wx/index/index_1/yonghu_select_do','wx\index\index_1@yonghu_select_do');
Route::post('/wx/index/index_1/yonghu_insert_do','wx\index\index_1@yonghu_insert_do');
Route::get('/wx/index/index_1/yonghu_select_1/{id}','wx\index\index_1@yonghu_select_1');
Route::get('/wx/index/index_1/yonghu_xiaoxi/{id}','wx\index\index_1@yonghu_xiaoxi');
Route::post('/wx/index/index_1/yonghu_xiaoxi_do','wx\index\index_1@yonghu_xiaoxi_do');

Route::post('/wx/index/index_1/event','wx\index\index_1@event');

//////////////////////////////////////////////////////
/// 生成带参数的二维码
Route::get('/wx/index/index_1/erwma','wx\index\index_1@erwma');
///
Route::get('/wx/index/index_1/erwmas','wx\index\index_1@erwmas');
Route::get('/wx/index/index_1/erwmas_do/{id}','wx\index\index_1@erwmas_do');
Route::get('/wx/index/index_1/erwmas_do_1/{id}','wx\index\index_1@erwmas_do_1');
//添加二维码推广商户
Route::get('/wx/index/index_1/shanghu','wx\index\index_1@shanghu');
Route::post('/wx/index/index_1/shanghu_do','wx\index\index_1@shanghu_do');

//微信菜单
//Route::get('/wx/index/index_1/caidan_1','wx\index\index_1@caidan_1');
Route::post('/wx/index/index_1/caidan_1_do','wx\index\index_1@caidan_1_do');
Route::get('/wx/index/index_1/caidan_2','wx\index\index_1@caidan_2');
Route::get('/wx/index/index_1/caidan_3','wx\index\index_1@caidan_3');
Route::get('/wx/index/index_1/caidan_1','wx\index\index_1@caidan_4');

Route::get('/wx/index/index_1/caidan','wx\index\index_1@caidan');
Route::get('/wx/index/index_1/caidan_delete/{id}','wx\index\index_1@caidan_delete');



//微信练题
Route::get('/wx/index/index_2/index','wx\index\index_2@index');
Route::post('/wx/index/index_2/index_do','wx\index\index_2@index_do');
Route::get('/wx/index/index_2/index_1','wx\index\index_2@index_1');
Route::get('/wx/index/index_2/index_2','wx\index\index_2@index_2');
Route::get('/wx/index/index_2/index_3','wx\index\index_2@index_3');
Route::get('/wx/index/index_2/index_biao','wx\index\index_2@index_biao');
Route::get('/wx/index/index_2/aaa','wx\index\index_2@aaa');

Route::group(['middleware' => ['biaobai']], function() {
    Route::get('/wx/index/index_2/index_4', 'wx\index\index_2@index_4');
    Route::get('/wx/index/index_2/index_4_do', 'wx\index\index_2@index_4_do');
    Route::post('/wx/index/index_2/index_41', 'wx\index\index_2@index_41');
    Route::get('/wx/index/index_2/index_5', 'wx\index\index_2@index_5');
    Route::get('/wx/index/index_2/login', 'wx\index\index_2@login');
    Route::get('/wx/index/index_2/code', 'wx\index\index_2@code');
});

//周考
Route::get('/wx/index/index_2/zhokao', 'wx\index\index_2@zhokao');
Route::get('/wx/index/index_2/zhokao_2/{uid}', 'wx\index\index_2@zhokao_2');
Route::group(['middleware' => ['zhokao']], function() {
    Route::get('/wx/index/index_2/zhokao_1', 'wx\index\index_2@zhokao_1');
    Route::get('/wx/index/index_2/zhokao_3', 'wx\index\index_2@zhokao_3');
    Route::post('/wx/index/index_2/zhokao_2_do', 'wx\index\index_2@zhokao_2_do');
});

//////////油价查询
Route::get('/wx/index/index_2/youjia', 'wx\index\index_2@youjia');
Route::get('ceshi', 'wx\index\index_2@ceshi');
Route::get('youjia', 'PriceController@price_api');



///考试
Route::get('kaoshi', 'wx\index\index_1@kaoshi');








//第九月
Route::get('app/denglu', 'app\admin\index@denglu');
Route::post('app/denglu_do', 'app\admin\index@denglu_do');

Route::group(['middleware' => ['admin']], function() {
Route::get('app/index/index', 'app\index@index');
Route::get('app/index/update/{id}', 'app\index@update');
Route::post('app/index/update_do', 'app\index@update_do');
Route::get('app/index/delete/{id}', 'app\index@delete');


Route::get('app/index/kao', 'app\index@kao');
Route::get('app', 'app\index@app');
Route::get('model', 'app\index@model');
Route::get('jieko', 'app\index@jieko');
Route::get('aaa', 'app\index@aaa');

Route::post('app/index/index_1', 'app\index@index_1');
Route::get('app/index/index_1', function () {
    return view('app/index/index_1');

});
//Route::any('app/index/delete_1', 'app\index@delete_1');
//Route::any('index/update_1', 'app\index@update_1');
//Route::any('app/index/update_11', 'app\index@update_11');
//Route::any('app/index/select_11', 'app\index@select_1');
Route::get('app/index/select_1', function () {
    return view('app/index/select_1');

});
Route::get('app/index/updata_1', function () {
    return view('app/index/updata_1');

});

Route::resource('app/index_1', 'app\index_1');

Route::get('layout/admin', function () {
    return view('layout/admin');
});


Route::resource('app/index_2', 'app\index_2');
//Route::get('app/index_2/insert', function(){
//    return view('app/index_2/insert');
//});
Route::get('app/admin1/insert', function () {
    return view('app/admin1/insert');

});
Route::get('app/admin1/select', function () {
    return view('app/admin1/select');

});
Route::get('app/admin1/update', function () {
    return view('app/admin1/update');

});





Route::get('app/jiemi/jie', 'app\jiemi@jie');
Route::get('app/jiemi/jie1', 'app\jiemi@jie1');

Route::get('app/jiemi/jiami', 'app\jiemi@jiami');
Route::get('app/jiemi/rsa', 'app\jiemi@rsa');
Route::get('app/jiemi/index', 'app\jiemi@index');

//第九月商品
Route::get('app/admin/index', 'app\admin\index@index');
//商品类型
Route::get('app/admin/insert_type', 'app\admin\index@insert_type');
Route::any('app/admin/insert_do', 'app\admin\index@insert_do');
Route::post('app/admin/insert_type_1', 'app\admin\index@insert_type_1');
Route::get('app/admin/select_type', 'app\admin\index@select_type');
//商品属性
Route::get('app/admin/insert_category', 'app\admin\index@insert_category');
Route::any('app/admin/insert_category_do', 'app\admin\index@insert_category_do');
Route::post('app/admin/insert_category_1', 'app\admin\index@insert_category_1');
Route::get('app/admin/select_attribute', 'app\admin\index@select_attribute');
//商品分类类型
Route::get('app/admin/insert', 'app\admin\index@insert');
Route::post('app/admin/insert1', 'app\admin\index@insert1');
Route::get('app/admin/select_category', 'app\admin\index@select_category');


Route::get('app/admin', function () {
    return view('app/admin');

});
//商品属性添加
Route::get('app/admin/insert_shuxing/{id}', 'app\admin\index@insert_shuxing');
Route::get('app/admin/select_shuxingchakan/{id}', 'app\admin\index@select_shuxingchakan');
Route::any('app/admin/shuxingchakan_do', 'app\admin\index@shuxingchakan_do');



//商品添加
Route::get('app/admin/insert_sptianjia', 'app\admin\index@insert_sptianjia');
Route::post('app/admin/insert_sptianjia_do', 'app\admin\index@insert_sptianjia_do');
Route::get('app/admin/care/{goods}', 'app\admin\index@care');
Route::post('app/admin/care_do', 'app\admin\index@care_do');
Route::get('app/admin/select_type1', 'app\admin\index@select_type1');

//商品展示
Route::get('app/admin/admin', 'app\admin\index@admin');
Route::any('app/admin/admin_do', 'app\admin\index@admin_do');
Route::any('app/admin/admin_gai', 'app\admin\index@admin_gai');

Route::get('app/admin/aa', 'app\admin\index@aa');
Route::get('app/admin/wuxian', 'app\admin\index@wuxian');
});

/**
 * 前台App接口开发
 */
Route::group(['middleware' => ['api_index']], function() {

    Route::any('api/index', 'api\index@index');
    Route::any('api/index_fenlei', 'api\index@index_fenlei');
    Route::any('api/index_fenlei_do', 'api\index@index_fenlei_do');

});

Route::any('api/index_xiang', 'api\index@index_xiang');
Route::any('api/index_fen', 'api\index@index_fen');
Route::any('api/index_attr', 'api\index@index_attr');
Route::any('api/login', 'api\index@login');

Route::group(['middleware' => ['api_login']], function() {

Route::any('api/as', 'api\index@as');

});




//Route::get('app/index/kao', 'app\index@kao');





////////////任务调度测试
Route::get('rewudiaodu', 'wx\index\index_1@rewudiaodu');
///////////////////////////////////////////////////////
/// //清零接口调用频次
Route::get('/wx/index/index_1/aa','wx\index\index_1@aa');
///////////////////////////////////////////////////////




