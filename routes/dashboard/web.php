<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web  Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::middleware(['auth', 'role:super_admin|admin'])->prefix('dashboard')->name('dashboard.')->group(function () {

            //-- welcome dashboard page
            Route::get('/', 'WelcomeController@index')->name('welcome');

            //-- user page
            Route::resource('user', 'UserController')->except('show');

            //-- Categories page
            Route::resource('category', 'CategoryController')->except('show');

            //-- Product page
            Route::resource('product', 'ProductController');

            //-- client pages
            Route::resource('client', 'ClientController');
            Route::resource('client.order', 'Client\OrderController');

            //-- orders
            Route::resource('order', 'OrderController');
            Route::get('/order/{order}/products', 'OrderController@products')->name('order.products');

            //-- stores
            Route::resource('store', 'StoreController');
        });
    }
);
