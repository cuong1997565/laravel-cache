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


// Route::get('radis', 'RadisController@Radis');

// Route::get('/article/{id}', 'RadisController@showArticle')->where('id','[0-9]+');

Route::get('article','BlogController@showBlog');
Route::get('article/{id}','BlogController@showArticle');
Route::get('filter/{name}','BlogController@showFilteredArticles');

Route::get('admin/addarticle','AdminController@showAddPost');
Route::post('admin/addarticle','AdminController@doAddPost');

Route::get('/{id}/feed', 'UserController@showFeed')->where('id', '[0-9]+');


Route::get('/{id}/postupdate', 'UserController@showAddUpdate')->where('id', '[0-9]+');

Route::post('/{id}/postupdate', 'UserController@doAddUpdate')->where('id', '[0-9]+');


Route::get('/{id}/userlist', 'UserController@showUserList')->where('id', '[0-9]+');

