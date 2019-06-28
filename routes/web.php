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


Route::get('/', 'FrontController@index');

Route::get('sold', 'FrontController@sold');

Route::get('category/{category}', 'FrontController@showByCategory');

Route::get('product/{id}', 'FrontController@show')->where(['id' => '[0-9]+']);
Auth::routes();


Route::get('admin', function () {
    return redirect()->action('ProductController@index');
});
Route::resource('admin/product', 'ProductController')->middleware('auth');
Route::resource('admin/category', 'CategoryController')->middleware('auth');
