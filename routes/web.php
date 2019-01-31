<?php

// Dashboard
Route::get('/', 'DashboardController')->name('dashboard');

Route::get('/inventory-list', 'InventoryListController')->name('inventoryList');

/**
 *  Routes Product
 */

// Index
Route::get('/product', [
    'as' => 'product.index' , 
    'uses' => 'ProductController@index'
]);

// Show
Route::get('/product/{id}', [
    'as' => 'product.show' , 
    'uses' => 'ProductController@show'
]);

// Show in PDF format
Route::get('/product/{id}/pdf', [
    'as' => 'product.productPdf' , 
    'uses' => 'ProductController@productPdf'
]);

// Show form to attach location
Route::get('/product/{id}/attach-location', [
    'as' => 'product.attachLocation' , 
    'uses' => 'ProductController@attachLocation'
]);

// Attach location to product
Route::post('/product/{id}/attach-location', [
    'as' => 'product.storeAttachLoaction' , 
    'uses' => 'ProductController@storeAttachLocation'
]);

// Show form to the move product
Route::get('/product/{product_id}/location/{location_id}/move-product', [
    'as' => 'product.moveProduct' , 
    'uses' => 'ProductController@moveProduct'
]);

// Move product to the new location
Route::post('/product/{product_id}/location/{location_id}/move-product', [
    'as' => 'product.storeMoveProduct' , 
    'uses' => 'ProductController@storeMoveProduct'
]);

// Detach location product
Route::post('/product', [
    'as' => 'product.detachLocation' , 
    'uses' => 'ProductController@detachLocation'
]);

/**
 *  Routes Location
 */

// Index
Route::get('/locations', [
    'as' => 'location.index' , 
    'uses' => 'LocationController@index'
]);

// Show location
Route::get('/location/{id}', [
    'as' => 'location.show' , 
    'uses' => 'LocationController@show'
]);


/**
 *  Routes Stock Level
 */

// 
Route::get('/stocklevel/discrepancy', [
    'as' => 'stocklevel.discrepancy' , 
    'uses' => 'StockLevelController@discrepancy'
]);

// Show in PDF format
Route::get('/stocklevel/discrepancy/pdf/', [
    'as' => 'stocklevel.discrepancyPdf' , 
    'uses' => 'StockLevelController@discrepancyPdf'
]);

Route::get('/stocklevel/expired/', [
    'as' => 'stocklevel.expired' , 
    'uses' => 'StockLevelController@expired'
]);

// Show in PDF format
Route::get('/stocklevel/expired/pdf/{days}', [
    'as' => 'stocklevel.expiredPdf' , 
    'uses' => 'StockLevelController@expiredPdf'
]);


/**
 *  Routes God Hand
 */
// Index
Route::get('/godhand', [
    'as' => 'godhand.index' , 
    'uses' => 'GodHandController@index'
]);
// GodHand
Route::post('/godhand/{id}', [
    'as' => 'godhand.godHand' , 
    'uses' => 'GodHandController@godHand'
]);