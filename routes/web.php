<?php

use Illuminate\Support\Facades\Auth;
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
*/

// Main page
Route::get('/', 'IndexController')->name('index');

// Products
Route::group(['namespace' => 'Product', 'prefix' => 'products'], function () {
    route::get('/', 'IndexController')->name('products.index');
    route::post('/', 'StoreController')->name('products.store');
    route::get('/{product}/edit', 'EditController')->name('products.edit');
    route::patch('/{product}', 'UpdateController')->name('products.update');
    route::delete('/{product}', 'DestroyController')->name('products.destroy');
});

// Substances
Route::group(['namespace' => 'Substance', 'prefix' => 'substances'], function () {
    route::get('/', 'IndexController')->name('substances.index');
    route::post('/', 'StoreController')->name('substances.store');
    route::get('/{substance}/edit', 'EditController')->name('substances.edit');
    route::patch('/{substance}', 'UpdateController')->name('substances.update');
    route::delete('/{substance}', 'DestroyController')->name('substances.destroy');
});

// Makers
Route::group(['namespace' => 'Maker', 'prefix' => 'makers'], function () {
    route::get('/', 'IndexController')->name('makers.index');
    route::post('/', 'StoreController')->name('makers.store');
    route::get('/{maker}/edit', 'EditController')->name('makers.edit');
    route::patch('/{maker}', 'UpdateController')->name('makers.update');
    route::delete('/{maker}', 'DestroyController')->name('makers.destroy');
});

Auth::routes();
