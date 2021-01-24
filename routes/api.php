<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Inventory Routes
Route::get('/category/list', 'CategoryController@allCategoryData');
Route::get('/department/list', 'DepartmentController@allDepartmentData');
Route::get('/unit/list', 'UnitController@allUnitData');
Route::get('/vendor/list', 'VendorController@allVendorData');
Route::post('/item/list', 'ProductController@productDataForSelectBox');
Route::post('/item/list/receive', 'LPOReceiveController@productReceiveForSelectBox');
Route::get('/item/list/init', 'ProductController@productInit');
Route::get('/location/list/init', 'StoreController@locationInit');
Route::get('/location/list/init/with/all', 'StoreController@locationInitWithAll');
Route::post('/selected_location/for/selectbox', 'StoreController@selectedStoreForSelectBoxById');

Route::post('/product/info', 'ProductController@productInfoById');
Route::post('/product/info/by/code', 'ProductController@productInfoByCode');
Route::post('/anatomy/item/info', 'ProductController@productAnatomoyById');
Route::post('/item/list/for/track', 'ProductController@productListForTrack');
Route::post('/location/info', 'StoreController@locationInfoById');
Route::post('/vendor/data/by/product_id', 'ProductController@productWiseVendorData');
Route::post('/selected_item/for/selectbox', 'ProductController@selectedItemForSelectBoxById');

// Item Related APi
Route::post('/item/info', 'ItemController@itemInfoById');
Route::post('/item/info/with/all', 'ItemController@itemInfoByIdWithAll');
//Route::post('/item/list', 'ItemController@itemDataForSelectBox');


// Location Related Api
Route::post('/location/list', 'LocationController@locationDataForSelectBox');
Route::post('/location/info', 'LocationController@locationDataById');
Route::post('/storereq/list', 'LocationController@storeDataForSelectBox');
Route::post('/storereq/info', 'LocationController@storeDataById');

// requistion store 

Route::get('/requisition-store', 'ProductController@reqStore');


// Location Related Api
Route::post('/vendor/list', 'VendorController@vendorDataForSelectBox');
Route::post('/vendor/info', 'VendorController@vendorDataById');


// Requisition related api
Route::post('requisition/items/by/id', 'RequisitionController@requstionItemsById');
Route::post('purchase/items/by/id', 'PurchaseController@purchaseItemsById');
Route::post('transfer/items/by/id', 'TransferController@transferItemsById');


Route::post('check/item/in/purchase', 'LPOReceiveController@checkItemsExistance');
Route::post('item/info/with/purchase', 'LPOReceiveController@itemInfoWithPurchase');

Route::post('check/item/in/transfer', 'TNTReceiveController@checkItemsExistance');
Route::post('item/info/with/transfer', 'TNTReceiveController@itemInfoWithTransfer');

Route::post('reference/generate', 'HelperController@generateReference');


Route::post('storewise/product/quantity/check', 'HelperController@quantityCheck');


Route::post('storewise/product/quantity/check/by/barcode', 'HelperController@quantityCheckByBarcode');

// product related api

Route::get('allproductswithbarcode', 'ProductController@allProductsWithBarcode');
Route::post('fetchproductbarcode', 'ProductController@fetchProductBarcode');
