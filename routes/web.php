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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/chat', 'Chat\ChatController@index')->name('chat');

Route::resource('product', 'ProductController');

Route::resource('ponda', 'PondaController');

Route::resource('weather', 'WeatherController');

Route::get('ponda/{ponda}/vote', 'PondaController@vote')->name('ponda.vote');

Route::post('ponda/{ponda}/sub', 'PondaController@sub')->name('ponda.sub');

Route::get('ponda/{ponda}/id_check', 'PondaController@id_check')->name('ponda.id_check');
