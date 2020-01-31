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

Route::get('/','HomeController@index')->name('home');

Route::get('/orders','StatController@index')->name('orders');
Route::get('/orders/edit/{id}','StatController@edit')->name('orders.edit');
Route::post('/orders/edit/{id}','StatController@update')->name('orders.update');
Route::get('/orders/delete','StatController@delete')->name('orders.delete');
