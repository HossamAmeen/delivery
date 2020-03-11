<?php

use Illuminate\Http\Request;

Route::namespace ("APIs")->group(function () {  
            ///// app 
    Route::get("cities", "MobileController@cities");
    Route::get("price-list", "MobileController@priceList");
    Route::get("services", "MobileController@services");
    Route::get("offers", "MobileController@showOffers");
    Route::post("complaint", "MobileController@complaint");
            //// client
    Route::post("register", "ClientController@register");
    Route::post("client/login", "ClientController@login");
    Route::middleware('auth:client-api')->group(function () {
        Route::get("account", "ClientController@getAccount");
        Route::put("account/update", "ClientController@updateAccount");
        Route::post("order", "ClientController@addOrder");
        Route::post("rate-order/{id}", "ClientController@addRate");
        Route::get("client/orders", "ClientController@showOrders");
        Route::put("account/update", "ClientController@updateAccount");
    });
    Route::post("delivery/login", "DeliveryController@login");
    Route::get("delivery/orders", "DeliveryController@orders");
    Route::get("delivery/last-order", "DeliveryController@lastOrder");
    Route::put("delivery/change-status/{orderId}", "DeliveryController@changeStatus");
});
