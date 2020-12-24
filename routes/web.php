<?php

use Illuminate\Support\Facades\Route;

Route::namespace('Cms')->group(function () {
    Route::prefix('cms')->group(function () {
        Route::get('test', 'HomeController@test');
        Route::namespace('Auth')->group(function () {
            Route::prefix('auth')->group(function () {
                // login
                Route::get('login', 'LoginController@index')->name('cms.auth.login');
                Route::post('login', 'LoginController@login');
                // forgot password
                Route::get('forgot', 'ResetPasswordController@index')->name('cms.auth.forgot');
                Route::post('forgot', 'ResetPasswordController@forgot');
                //verify reset token
                Route::get('verifyToken/{email}/{token}', 'ResetPasswordController@verifyToken');
                // reset password
                Route::post('reset', 'ResetPasswordController@reset');
                //logout
                Route::get('logout', 'LoginController@logout');
            });
        });
        Route::middleware('cms.auth')->group(function () {
            Route::get('/dashboard', 'HomeController@index')->name('cms.home');
            //user
            Route::resource('user', 'UserController');
            //admin
            Route::prefix('admin')->group(function () {
                Route::resource('', 'AdminController');
                //Route::get('confirm','CategoryController@confirm');
            });
            //category
            Route::prefix('category')->group(function () {
                Route::resource('', 'CategoryController');
                //Route::get('confirm','CategoryController@confirm');
            });
            //producer
            Route::prefix('producer')->group(function () {
                Route::resource('', 'ProducerController');
                //Route::get('confirm','CategoryController@confirm');
            });
            //product
            Route::prefix('product')->group(function () {
                Route::resource('', 'ProductController');
                //Route::get('confirm','CategoryController@confirm');
            });
            //Bill
            Route::prefix('order')->group(function () {
                Route::resource('', 'BillController');
                Route::get('/{type}', 'BillController@index');
            });
            //Sale
            Route::resource('sale', 'SaleController');
            //coupon
            Route::resource('coupon', 'BillController@index');
            //control
            Route::prefix('control')->group(function () {
                Route::get('', 'ControlController@control');
                Route::get('export', 'ControlController@export');
                Route::put('import', 'ControlController@import');
            });
        });
    });
});

Route::namespace('Web')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::prefix('auth')->group(function () {
            Route::middleware('loginMiddleware')->group(function () {
                Route::get('login', 'LoginController@index')->name('auth.login');
                Route::post('signin', 'LoginController@login');
                Route::get('logout', 'LoginController@logout');
            });

            Route::get('signup', 'RegistraController@index')->name('auth.getsignup');
            Route::post('signup', 'RegistraController@signup')->name('auth.signup');

            Route::get('change_password', 'ChangePasswordController@index');
            //Route::put('/change_password', 'ChangePasswordController@changePassword');

            Route::get('/forgot_password', 'ForgotPasswordController@index');
            //Route::put('/forgot_password', 'ForgotPasswordController@forgotPassword');

            Route::get('/reset_passwrod', 'RessetPasswordController@index');
            //Route::put('/reset_passwrod','RessetPasswordController@reset');

            // logi with gg
            Route::get('/redirect/{provider}', 'LoginController@redirect');
            Route::get('/callback/{provider}', 'LoginController@callback');
        });
    });
    //home
    Route::get('', 'HomeController@index');
    Route::get('/index', 'HomeController@index')->name('web.index');
    // search
    Route::get('search', 'HomeController@search');
    // contact
    Route::get('/contact', 'HomeController@contact')->name('web.contact');
    Route::post('/feedback', 'HomeController@sendMessage');
    // blog
    //Route::get('/blog', 'HomeController@blog')->name('web.blog');
    //Route::get('/blog_detail', 'HomeController@blog_detail')->name('web.blog_detail');
    // category
    Route::resource('/category', 'CategoryController')->only('index');
    Route::middleware('loginMiddleware')->group(function () {
        // cart
        Route::prefix('cart')->group(function () {
            Route::get('', 'CartController@index');
            Route::get('add/{id}', 'CartController@store');
            Route::get('update/{product_id}/{action}', 'CartController@update');
            // checkout
            Route::get('check_out', 'CheckOutController@checkOut');
            // payment
            Route::post('payment', 'CheckOutController@payment');
            // confirm cart
            Route::post('confirm', 'CheckOutController@confirm');
            Route::post('order', 'CheckOutController@order');
        });
        Route::get('district/{id}', 'CheckOutController@getDistrict');
        Route::get('ward/{id}', 'CheckOutController@getWard');
        Route::get('thanks', 'HomeController@thanks');
    });
    // match route
    Route::get('{type}/{key}', 'RouteController@match');
});
