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

// Route::get('/', 'Dashboard\ConfigrationController@index');
Route::prefix('admin')->group(function () {
    Auth::routes();
    Route::namespace ('Dashboard')->group(function () {
        Route::any('sendToken', 'ConfigrationController@sendToken')->name('forget.password');
        Route::any('paswordreset/{id}/{token}', 'ConfigrationController@paswordreset');
        // Route::post('login', 'BackEnd\UserController@login');
        Route::middleware('auth')->group(function () {

            Route::get('/', 'UserController@index');
            Route::resource('configrations', 'ConfigrationController');
            Route::resource('users', 'UserController');
            Route::resource('clients', 'ClientController');
            Route::resource('deliveries', 'DeliveryController');
            Route::resource('orders', 'OrderController');
            Route::get('show-orders/{status}', 'OrderController@show')->name('show-orders');
            Route::get('show-orders-delivery/{deliveryId}', 'OrderController@showOrderWithDelivery');
            Route::get('change-status-order/{status}/{orderId}/{deliveryId?}', 'OrderController@changeStatus');
            Route::resource('offers', 'OfferController');
            Route::resource('services', 'ServiceController');
            Route::resource('pricelists', 'PriceListController');
            Route::resource('attendces', 'AttendceController');
            Route::resource('questions', 'UserController');
            Route::resource('complaints', 'ComplaintController');
            Route::resource('sanctions', 'SanctionController');
            Route::resource('accounts', 'AccountController');
            Route::resource('dailyaccounts', 'DailyAccountController');
            Route::get('dailyaccounts/{id}/recieved', 'DailyAccountController@recievedMoney');
            Route::get('order/count', 'OrderController@orderCount');
            Route::get('complaint/count', 'ComplaintController@UnReadComplaintCount');
            Route::get('read/complaint', 'ComplaintController@updateStatusComplaint');     /////////////// change column is_read to 1

        });

    });
});
Route::get('/', 'Dashboard\ConfigrationController@index')->name('home');
Route::get('/',function()
{
    return view('index');
})->name('index');
Route::get('firebase/{id}/{id2}','FirebaseController@index');
