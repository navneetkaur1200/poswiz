<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('login');
});

Auth::routes();

Route::get('login',['as'=>"login",'uses'=>"App\Http\Controllers\Auth\LoginController@loginform"]);

Route::post('login',['as'=>"login",'uses'=>"App\Http\Controllers\Auth\LoginController@login"]);
Route::get('register', function () {
    return redirect('login');
});
Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware'=>['auth','admin']], function () {

    Route::get('dashboard', ['as'=>'dashboard', 'uses'=>'App\Http\Controllers\Admin\HomeController@dashboard']);

    Route::get('my-porfile', ['as'=>'home', 'uses'=>'App\Http\Controllers\Admin\HomeController@profile']);
    Route::get('my-porfile', ['as'=>'profile', 'uses'=>'App\Http\Controllers\Admin\HomeController@profile']);
    Route::get('profile-edit', ['as'=>'profile-edit', 'uses'=>'App\Http\Controllers\Admin\HomeController@profile_edit']);
    Route::post('my-porfile-save', ['as'=>'my_profile_save', 'uses'=>'App\Http\Controllers\Admin\HomeController@profile_update']);

     /*Users*/
     Route::group(['prefix'=>'subscriber','as'=>'subscriber.','middleware'=>['admin']],function(){
        Route::get('create',['as'=>'new_user','uses'=>'App\Http\Controllers\Admin\SubscriberController@create']);
        Route::post('create',['as'=>'new_save','uses'=>'App\Http\Controllers\Admin\SubscriberController@store']);
        Route::get('manage',['as'=>'manage','uses'=>'App\Http\Controllers\Admin\SubscriberController@show']);
        Route::get('getAjaxList',['as'=>'showAjaxList','uses'=>'App\Http\Controllers\Admin\SubscriberController@showList']);

        Route::get('edit/{id}',['as'=>'edit','uses'=>'App\Http\Controllers\Admin\SubscriberController@edit']);
        Route::post('edit/{id}',['as'=>'edit_save','uses'=>'App\Http\Controllers\Admin\SubscriberController@update']);
        Route::get('view/{id}',['as'=>'view','uses'=>'App\Http\Controllers\Admin\SubscriberController@view']);
        Route::get('article-list/{id}',['as'=>'article_list','uses'=>'App\Http\Controllers\Admin\SubscriberController@article_list']);
        Route::get('delete/{id}',['as'=>'delete','uses'=>'App\Http\Controllers\Admin\SubscriberController@delete']);
    });
    
    
     /*Settings*/
     Route::group(['prefix'=>'settings','as'=>'setting.'],function(){
        Route::get('common',['as'=>'common','uses'=>'App\Http\Controllers\Admin\SettingController@common']);
        Route::post('common-update',['as'=>'common_update','uses'=>'App\Http\Controllers\Admin\SettingController@common_save']);
    });
    Route::group(['prefix'=>'notifications','as'=>'notifications.'],function(){
        Route::get('manage',['as'=>'manage','uses'=>'App\Http\Controllers\Admin\NotificationsController@show']);
    });
    Route::group(['prefix'=>'logs','as'=>'log.'],function(){
        Route::get('manage',['as'=>'manage','uses'=>'App\Http\Controllers\Admin\LogsController@show']);
        Route::get('getAjaxList',['as'=>'showAjaxList','uses'=>'App\Http\Controllers\Admin\LogsController@showList']);
        Route::post('delete-all',['as'=>'deletall','uses'=>'App\Http\Controllers\Admin\LogsController@deleteAll']);
    });
});

Route::group(['prefix' => 'ajax', 'as' => 'ajax.'], function () {
    Route::post('load-locations',['as'=>'loadLocations','uses'=>'App\Http\Controllers\AjaxController@get_location']);

    Route::post('picture-delete',['as'=>'delete_file','uses'=>'App\Http\Controllers\CommonController@pictureDelete']);

    Route::post('ajax-upload',['as'=>'ajax_upload','uses'=>'App\Http\Controllers\CommonController@pictureUploadProperty']);
    Route::post('ajax-upload-single',['as'=>'ajax_upload','uses'=>'App\Http\Controllers\CommonController@pictureUploadSingle']);
    Route::post('ajax-delete',['as'=>'filedelete','uses'=>'App\Http\Controllers\CommonController@pictureDeleteProperty']);
    Route::post('email-check',['as'=>'email_check','uses'=>'App\Http\Controllers\AjaxController@email_check']);
});
Route::get('test',['as'=>"test",'uses'=>"App\Http\Controllers\Api\HomeController@test"]);
