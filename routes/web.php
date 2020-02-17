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

Route::get('users/{id}', function ($id) {
      $redis = app()->make('redis');
      $redis->set("key1","testValue");
      return $redis->get("key1");

});


Route::get('radis', 'RadisController@Radis');

Route::get('/article/{id}', 'RadisController@showArticle')->where('id','[0-9]+');
