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
|
*/

Route::group(['prefix' => 'admin'], function() {
    Route::get('{any}'                 , [ 'uses'        => 'App\Http\Controllers\SiteController@admin' , 'as'          => 'admin'] )->where('any', '.*');
});

Route::get('/captcha-image'        , [ 'uses'        => 'App\Http\Controllers\CaptchaImage@gerate']);
Route::get('/captcha-loaded-image' , [ 'uses'        => 'App\Http\Controllers\CaptchaImage@getImageSession']);
Route::get('{any}'                 , [ 'uses'        => 'App\Http\Controllers\SiteController@index' , 'as'          => 'home'] )->where('any', '.*');

