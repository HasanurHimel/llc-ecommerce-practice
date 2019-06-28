<?php

Route::group(['namespace'=>'Frontend'], function (){

    Route::get('/', 'HomeController@index')->name('frontend.home');
    Route::get('/product/{slug}', 'ProductController@detail')->name('product.show');
    Route::get('/cart-show', 'CartController@show')->name('cart.show');
    Route::post('/cart', 'CartController@add')->name('cart.add');
    Route::post('/cart/delete', 'CartController@delete')->name('cart.delete');
    Route::post('/cart/update', 'CartController@qty_update')->name('qty.update');
    Route::get('/cart/checkout', 'CartController@checkout_show')->name('cart.checkout');
    Route::get('/cart/destroy', 'CartController@cart_destroy')->name('cart.destroy');

//                   User register & login

    Route::get('/register', 'AuthController@showRegisterForm')->name('register');
    Route::post('/register', 'AuthController@proccessRegister');
    Route::get('/login', 'AuthController@showLoginForm')->name('login');
    Route::post('/login', 'AuthController@proccessLogin');
    Route::get('/activate/{token}', 'AuthController@activateUser')->name('activate');

    Route::group(['middleware' =>'auth'], function (){
        Route::get('/logout', 'AuthController@logout')->name('logout');
        Route::post('/order', 'CartController@order')->name('order');

    });




});

