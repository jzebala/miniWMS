<?php

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

/* ---- ADMIN ROUTE ---- */
Route::group(['middleware' => 'roles', 'roles' => 'Admin'], function()
{

// Dashboard
Route::get('/', 'DashboardController')->name('dashboard');

// Inventory list PDF
Route::get('/inventory-list/pdf', [
    'as' => 'InventoryListPdf' , 
    'uses' => 'InventoryListController@InventoryListPdf'
]);

Route::get('/inventory-list', [
    'as' => 'InventoryList.index' , 
    'uses' => 'InventoryListController@index'
]);

Route::post('/inventory-list', [
    'as' => 'InventoryList.abc' , 
    'uses' => 'InventoryListController@abc'
]);

/**
 * Routes User
 */

// Show user by ID
Route::get('/user/{name}', [
    'as' => 'user.show' , 
    'uses' => 'UserController@show'
]);

// Change password form
Route::get('/user/{name}/change-password', [
    'as' => 'user.changePasswordForm',
    'uses' => 'UserController@changePasswordForm'
]);

// Change password
Route::post('/user/{name}/change-password', [
    'as' => 'user.changePassword',
    'uses' => 'UserController@changePassword'
]);

/**
 *  Routes Product
 */

// Index
Route::get('/product', [
    'as' => 'product.index' , 
    'uses' => 'ProductController@index'
]);

// Export products to Excel
Route::get('/product/export/excel', [
    'as' => 'product.exportExcel' , 
    'uses' => 'ProductController@exportExcel'
]);

Route::post('/product/import', [
    'as' => 'product.import' , 
    'uses' => 'ProductController@import'
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

// Detach product from location
Route::post('/location', [
    'as' => 'location.detachProduct' , 
    'uses' => 'LocationController@detachProduct'
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

});