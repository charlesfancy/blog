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

Route::get('/ponda', function () {
    return view('ponda');
});

Route::get('/product', function () {
    return view('product');
});

Route::get('/weather', function () {
    return view('weather');
});

Route::get('/client', function () {
    return view('client');
});

Route::get('/order', function () {
    return view('order');
});

Route::get('/verify-email', 'Auth\RegisterController@verifyEmail')->name('email.verify');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('product', 'ProductController');

Route::resource('ponda', 'PondaController');

Route::resource('weather', 'WeatherController');

Route::resource('client', 'ClientController');

Route::resource('order', 'OrderController');

Route::get('ponda/{ponda}/vote', 'PondaController@vote')->name('ponda.vote');

Route::post('ponda/{ponda}/sub', 'PondaController@sub')->name('ponda.sub');

Route::get('ponda/{ponda}/id_check', 'PondaController@id_check')->name('ponda.id_check');

Route::group(['prefix' => 'merchandise'],function(){
    Route::get('/', 'MerchandiseController@merchandiseListPage');
    Route::get('/create', 'MerchandiseController@merchandisCreateProcess');
    Route::get('/manage', 'MerchandiseController@merchandisManageListPage');

    Route::group(['prefix' => '{merchandise_id}'], function(){
        Route::get('/', 'MerchandiseController@merchandiseItemPage');
        Route::get('/edit', 'MerchandiseController@merchandiseItemEditPage');
        Route::put('/', 'MerchandiseController@merchandiseItemUpdateProcess');
        Route::post('/buy', 'MerchandiseController@merchandiseItemBuuProcess');
    });
});