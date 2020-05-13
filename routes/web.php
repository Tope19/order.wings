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

Route::get('/index', function () {
    return view('index');
});

Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/details', 'OrderController@details')->name('details');
Route::get('/signin', 'OrderController@signin')->name('signin');
Route::post('/check_amount', 'OrderController@checkAmount')->name('check_amount');

Route::group(['middleware' => ['verified','userRole']], function () {
    Route::get('/userHome', 'UserController@userHome')->name('userHome');
    Route::get('/orderHistory', 'UserController@orderHistory')->name('orderHistory');
    Route::get('/userTransactionHistory', 'UserController@userTransactionHistory')->name('userTransactionHistory');
    Route::get('/addOrderDetails', 'UserController@addOrderDetails');
    Route::get('/makePayment', 'UserController@makePayment')->name('makePayment');
    Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay'); 
    Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
    Route::post('/enterDetails', 'UserController@enterDetails')->name('enterDetails'); 
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');