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

Route::get('/index', 'ProductController@index');

Route::post('/index', 'ProductController@store')->name('product.store');

Route::patch('/index', [ 'uses' => 'ProductController@update', 'as' => 'product.update']);

Route::delete('/index', [ 'uses' => 'ProductController@destroy', 'as' => 'product.destroy' ]);

Route::get('/search', [ 'uses' => 'ProductController@search', 'as' => 'search']);

Route::get('/noresult', [ 'uses' => 'ProductController@noresult', 'as' => 'noresult']);

Auth::routes();

