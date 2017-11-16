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
    return view('dashboard');
})->middleware('auth');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');
// Route::get('/system-management/{option}', 'SystemMgmtController@index');
Route::get('/profile', 'ProfileController@index');

Route::post('user-management/search', 'UserManagementController@search')->name('user-management.search');
Route::resource('user-management', 'UserManagementController');

Route::resource('employee-management', 'EmployeeManagementController');
Route::post('employee-management/search', 'EmployeeManagementController@search')->name('employee-management.search');
Route::get('avatars/{name}', 'EmployeeManagementController@load');

Route::get('/vendors', function () {

    return view('admin.vendor');
})->middleware('auth');

Route::get('/product', function () {
    return view('admin.product');
})->middleware('auth');

Route::get('/purchase', function () {
    return view('admin.purchase');
})->middleware('auth');

//request odoo
// Route::get('/get/product',array('middleware' => 'cors', 'uses' => 'OdooController@getProduct'));
Route::get('/get/product','OdooController@getProduct');

Route::get('/get/purchase','OdooController@getPurchase');

Route::get('/get/purchase/product','OdooController@getProductPurchase');

Route::get('/get/purchase/report','OdooController@getPurchaseReport');

Route::get('/get/inventory/valuation','OdooController@getInventoryValuationByProductId');

Route::get('/get/weather','OdooController@getWeather');


//DASHBOARD
Route::get('/get/dashboard/count', 'DashboardController@getDashboardCount');


//VENDOR
Route::resource('vendor', 'VendorController');

Route::get('/get/vendor','VendorController@index');

Route::post('/update/vendor', 'VendorController@updateVendor');

Route::post('/delete/vendor', 'VendorController@deleteVendor');


//PRODUCT VENDOR
Route::post('/add/product/vendor', 'VendorController@storeProductVendor');

Route::post('/get/product/vendor','VendorController@getVendorProduct');

Route::post('/delete/product/vendor', 'VendorController@deleteVendorProduct');

Route::post('/delete/product/vendor/choose', 'VendorController@deleteVendorProductChoose');

Route::post('/update/product/vendor', 'VendorController@updateVendorProduct');

Route::get('/edit/vendor/product', function() {
    return View::make('admin.vendorProduct');
})->middleware('auth');


//PRODUCT
Route::resource('productModel', 'ProductController');

Route::post('/update/product', 'ProductController@updateProduct');

Route::post('/delete/product', 'ProductController@deleteProduct');

Route::get('/choose/product', function() {
    return View::make('admin.chooseProduct');
})->middleware('auth');


//PURCHASE ORDER
Route::get('/get/purchase/order', 'PurchaseController@index');

Route::get('/choose/product/purchase', function() {
    return View::make('admin.chooseProductVendorPurchase');
})->middleware('auth');

Route::post('/data/product/vendor/purchase', 'PurchaseController@dataProductVendor');

Route::get('/data/product/vendor/purchase', 'PurchaseController@getDataProductPurchase');

Route::post('/data/cart/purchase', 'PurchaseController@store');

Route::get('/cart/product/purchase', function() {
    return View::make('admin.purchaseCart');
})->middleware('auth');

Route::post('/update/purchase/comodity/price', 'PurchaseController@updateComodityPricePurchase');

Route::post('/data/product/vendor/purchase/line', 'PurchaseController@dataProductVendorPurchaseLine');

Route::get('/data/product/vendor/purchase/line', 'PurchaseController@getDataProductPurchaseLine');

Route::get('/purchase/detail', function() {
    return View::make('admin.purchaseDetail');
})->middleware('auth');

Route::get('/purchase/payment', function() {
    return View::make('admin.purchasePayment');
})->middleware('auth');

//INVENTORY
Route::get('/inventory/comodity', function () {
    return View::make('admin.inventoryProduct');
})->middleware('auth');

Route::get('/inventory/comodity/item', function () {
    return View::make('admin.inventoryProductChoose');
})->middleware('auth');

Route::post('/inventory/comodity/item', 'InventoryController@dataProductByItem');

Route::get('/get/inventory/comodity/item', 'InventoryController@getDataProductByItem');

Route::post('/inventory/process/item', 'InventoryController@dataVendorProductByItem');

Route::get('/get/inventory/process/item', 'InventoryController@getDataVendorProductByItem');

Route::post('/update/inventory/process', 'InventoryController@updateProductInventoryProcess');

Route::post('/update/inventory/result', 'InventoryController@updateProductInventoryResult');

Route::get('/inventory/stock', function () {
    return View::make('admin.inventoryStockProduct');
})->middleware('auth');

Route::get('/get/inventory/stock', 'InventoryController@getDataStockComodityInventory');