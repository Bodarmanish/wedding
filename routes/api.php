<?php

use Illuminate\Http\Request;

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
Route::post('register', 'Api\userController@register')->name('register');
Route::post('login', 'Api\userController@login')->name('login');

Route::group(['middleware' => ['jwt.verify']], function () {
  Route::get('category', 'Api\categoryController@getCategory');
  Route::get('sub_category', 'Api\categoryController@subCategory');
  Route::get('wedding_Ideas', 'Api\categoryController@wedding_Ideas');
  Route::get('Trending', 'Api\categoryController@Trending');
  Route::get('City', 'Api\categoryController@city');
  Route::post('Search', 'Api\categoryController@search');
    
});
