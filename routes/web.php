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

// Auth::routes();
Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('root');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product/{id}/{title?}', 'HomeController@product')->name('product');

Route::middleware(['auth', 'role'])->group(function(){
    Route::namespace('Admin')->group(function(){
        Route::get('/admin', 'AdminController@index')->name('admin');
        Route::prefix('admin')->group(function(){
            Route::prefix('user')->group(function(){
                    Route::get('/', 'UserController@index')->name('user');
                    Route::get('/json', 'UserController@json')->name('user.json');
                    Route::get('/add', 'UserController@create')->name('user.add');
                    Route::post('/store', 'UserController@store')->name('user.store');
                    Route::get('/edit/{id}', 'UserController@edit')->name('user.edit');
                    Route::patch('/edit/{id}', 'UserController@update')->name('user.update');
                    Route::delete('/delete/{id}', 'UserController@destroy')->name('user.destroy');
            });
            Route::prefix('product')->group(function(){
                Route::get('/', 'ProductController@index')->name('product');
                Route::get('/json', 'ProductController@json')->name('product.json');
                Route::get('/add', 'ProductController@create')->name('product.add');
                Route::post('/store', 'ProductController@store')->name('product.store');
                Route::get('/edit/{id}', 'ProductController@edit')->name('product.edit');
                Route::patch('/edit/{id}', 'ProductController@update')->name('product.update');
                Route::delete('/delete/{id}', 'ProductController@destroy')->name('product.destroy');
            });
        });
    });
});

Route::get('google', 'GoogleController@redirect');
Route::get('google/callback', 'GoogleController@callback');
