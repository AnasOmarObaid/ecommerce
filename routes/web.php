<?php

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],


    function () {
        // cart view

        Route::name('front.')->group(function () {

            // welcome view
            Route::get('/', 'welcomeController@index')->name('welcome');

            // product view
            Route::resource('product', 'ProductController');

            // rating view
            Route::resource('rating', 'RatingController');

            // cart view
            Route::resource('cart', 'CartController');

            // cart view
            Route::resource('cart', 'CartController');

            // control cart
            Route::get('cart/{product}/delete', 'CartController@delete')->name('cart2.delete');
            Route::get('cart/{product}/add', 'CartController@add')->name('cart2.add');
            Route::post('cart/update', 'CartController@updateCart')->name('cart2.updateCart');

            //user view
            Route::resource('user', 'UserController');
            Route::get('/users/data', 'UserController@userData')->name('userData');

            //order controller
            Route::resource('order', 'OrderController');
            Route::post('order/store', 'OrderController@storeProductFromCart')->name('order2.storeProduct');
            Route::post('order/confirm/{order}', 'OrderController@OrderConfirm')->name('order_confirm');
            Route::post('order/create/{product}', 'OrderController@create_order')->name('order_create');


            // pat view
            Route::get('/pay', function () {
                return view('pay.index');
            })->name('pay.index')->middleware('auth');

            // confirm controller
            Route::get('confirm', function () {
                return view('confirm');
            })->name('confirm')->middleware('auth');


            // alerts view
            Route::get('alert', function () {

                return view('alert');
            })->name('alert')->middleware('auth');


            // rating view
            Route::get('rating', function () {

                return view('rating');
            })->name('rating')->middleware('auth');

            // store controller
            Route::resource('store', 'StoreController');

            // comme soon
            Route::get('/merchant', function () {

                return view('merchant');
            })->name('merchant'); //-- end merchant route


            //contact us 
            Route::get('/contact', function () {

                return view('contact');
            })->name('contact');

            //support  
            Route::get('/support', function () {

                return view('support');
            })->name('support');

            //support  
            Route::get('/deliveries', function () {

                return view('delivery');
            })->name('delivery');

            //support  
            Route::get('/nama', function () {

                return view('nama');
            })->name('nama');
        });
    }
);


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
