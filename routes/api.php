<?php

use Illuminate\Http\Request;

Route::namespace ("APIs")->group(function () {
    Route::post("register", "ClientController@register");
//         Route::put("client/update/profile" , "ClientController@updateProfile");
    Route::post("client/login", "ClientController@login");
    Route::get("account", "ClientController@getAccount");
    Route::put("account/update", "ClientController@updateAccount");
    Route::get("cities", "MobileController@cities");
    Route::get("price-list", "MobileController@priceList");
    Route::get("services", "MobileController@services");
    Route::post("complaint", "MobileController@complaint");
//

    Route::middleware('auth:client-api')->group(function () {
    Route::post("order", "ClientController@addOrder");
    Route::post("rate-order/{id}", "ClientController@addRate");
    Route::get("client/orders", "ClientController@showOrders");
    });
    // Route::middleware('auth:client')->group(function () {
    //     Route::post("order-testM" , "ClientController@addOrder");
    //     Route::post("rate-order/{id}" , "ClientController@addRate");
    //     Route::get("client/orders" , "ClientController@showOrders");
    // });
    Route::post("rate-order-test/{id}", "ClientController@addRate");
//         Route::post('service-provider/login', 'ServiceProviderController@login');
    //         Route::middleware('auth:service-provider-api')->group(function () {
    //             Route::get('service-provider/service-type/', 'ServiceProviderController@get_service_type');
    //             Route::post('service-provider-service/add', 'ServiceProviderController@add_service_provider_service');
    //         });

    Route::prefix('test')->group(function () {
        Route::middleware('auth:api')->group(function () {
        Route::post("order", "ClientController@addOrder");
    }); });
});
