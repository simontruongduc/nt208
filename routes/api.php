<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::namespace('Api\Auth')->group(function () {
    Route::prefix('registration')->group(function () {
        // login (Post)
        // api/beta/login
        Route::post('login', 'AuthController@login')->name('api.registration.login');
        // signout (Get)
        //api/beta/logout
        Route::get('logout','AuthController@logout')->name('api.registration.logout')->middleware('checkLogin');
        // signup (Post)
        // api/beta/signup
        Route::post('signup','AuthController@signup')->name('api.registration.signup');
        // verifyAccount (Get)
        //api/beta/verifyAccount
        Route::get('verifyAccount/{email}/{token}','AuthController@verifyAccount')->name('api.registration.verifyAccount');
        // forgotPassword (Post)
        //api/beta/forgotPassword
        Route::post('forgotPassword','AuthController@forgotPassword');////////
        // checkVerifyToken (Get)
        //api/beta/checkVerifyToken
        Route::get('checkVerifyToken/{email}/{token}','AuthController@checkVerifyToken');
        // resetPassword (Put)
        //api/beta/forgotPassword
        Route::post('resetPassword','AuthController@resetPassword');
        // changePassword (Post)
        //api/beta/changePassword
        Route::post('changePassword','AuthController@changePassword')->middleware('checkLogin');
    });
});
Route::namespace('Api\Auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('information','AuthController@getUserInformation')->middleware('checkLogin');
    });
});
Route::namespace('Api\Category')->group(function () {
    Route::prefix('category')->group(function () {
        Route::get('', 'CategoryController@index');
        Route::get('{category}/products','CategoryController@getProductsOfCategory');
    });
});
Route::namespace('Api\Product')->group(function () {
        Route::resource('product','ProductController');
        Route::get('search','ProductController@search');
});
Route::namespace('Api\Cart')->group(function () {
    Route::prefix('cart')->group(function () {
        Route::resource('','CartController')->middleware('checkLogin');
        Route::post('update','CartController@updateCart')->middleware('checkLogin');
        Route::post('delete','CartController@delete')->middleware('checkLogin');
        Route::get('checkout','CartController@checkout')->middleware('checkLogin');
        Route::post('order_detail','CartController@orderDetail')->middleware('checkLogin');
        Route::post('billing_information','CartController@billingInformation')->middleware('checkLogin');
        Route::post('confirm','CartController@confirm')->middleware('checkLogin');
    });
});
Route::namespace('Api\Bill')->group(function () {
    Route::prefix('bill')->group(function () {
        Route::resource('','BillController');
    });
});

Route::namespace('Web')->group(function () {
    Route::post('create-payment','PayPalController@createPayment');
    Route::post('execute-payment','PayPalController@executePayment');
});