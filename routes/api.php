<?php

use Illuminate\Support\Facades\Route;

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
Route::namespace('API\General\Auth')->prefix('general/auth/')->group(function () {
    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
    
    Route::post('ForgetPassword', 'ForgetPasswordController@ForgetPassword');
    
    Route::middleware(['auth:api','role:client'])->group(function () {
        Route::post('ChangePassword', 'ChangePasswordController@ChangePassword');
        Route::post('verification', 'VerificationController@verification');
        Route::post('logout', 'LoginController@logout');
        Route::put('UpdateUser', 'LoginController@UpdateUser');
        Route::get('user', 'LoginController@user');
    });
});

Route::namespace('API\General')->prefix('general')->middleware(['auth:api'])->group(function () {
    //notifications routes
    Route::get('/notifications', 'NotificationsController@notifications');
    Route::get('/readNotification/{id}', 'NotificationsController@readNotification');
    Route::delete('/deleteNotification/{id}', 'NotificationsController@deleteNotification');
    Route::delete('/notifications_delete', 'NotificationsController@notifications_delete');

    //sendMassage routes
    // Route::post('/sendMassage', 'SendMassageController@sendMassage');
    //index routes
    Route::get('/', 'WelcomeController@index')->withoutMiddleware('auth:api');
    //setting routes
    Route::post('/contact_us', 'WelcomeController@contact_us');
});


Route::namespace('API\Client')->prefix('client')->group(function () {

    Route::middleware(['auth:api', 'role:client'])->group(function () {
        //favorites routes
        Route::get('favorite', 'FavoriteController@index');
        Route::post('favorite', 'FavoriteController@storeOrDestroy');
        //orders routes
        Route::post('orders', 'OrderController@store');
        Route::get('orders', 'OrderController@index');
        Route::get('orders/{order}/show', 'OrderController@show');
        Route::post('orders/{order}/rating', 'OrderController@rating');
        
        //Check Coupon routes
        Route::post('checkCoupon', 'OrderController@checkCoupon');
    });

    //categories routes
    Route::get('categories', 'CategoryController@index');
    
    //products routes
    Route::get('products/{category}', 'ProductController@index');
    Route::get('productsMost/{category}', 'ProductController@productsMost');
    Route::get('bestDealsProducts/', 'ProductController@bestDealsProducts');

});
