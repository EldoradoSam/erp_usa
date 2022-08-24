<?php

use App\Http\Controllers\CountryListController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\CustomerOrderListController;
use App\Http\Controllers\CustomerOrderThreadController;
use App\Http\Controllers\GnCustomerController;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SupplierSettingController;
use Illuminate\Support\Facades\Route;

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
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::get('/customer', function () {
    return view('customer');
});

Route::get('/customerList', function () {
    return view('customerList');
});



Route::get('/countryList', function () {
    return view('country_list');
});


Route::get('/customerOrder', function () {
    return view('customerOrder');
});


Route::get('/orderList', function () {
    return view('orderList');
});


Route::get('/orderSettings', function () {
    return view('settings');
});


//customer
Route::get('/supplier/settings/allCountry', [SupplierSettingController::class, 'AllCountry']);
Route::get('/supplier/allGLPostingData', [SupplierSettingController::class, 'AllGLPostData']);

Route::get('/Customer/checkcustomerID/{id}', [GnCustomerController::class, 'checkcustomerID']);
Route::post('/Customer/saveCustomer', [GnCustomerController::class, 'saveCustomer']);
Route::get('/Customer/EditCustomer/{id}', [GnCustomerController::class, 'EditCustomer']);
Route::post('/Customer/updateCustomer', [GnCustomerController::class, 'updateCustomer'])->middleware('can:st_customer_edit');

//customer contacts
Route::post('/Customer/savecontacts', [GnCustomerController::class, 'savecontacts']);
Route::get('/Customer/loadcontacts/{id}', [GnCustomerController::class, 'loadcontacts']);
Route::delete('/Customer/deletecontacts/{id}', [GnCustomerController::class, 'deletecontacts']);
Route::get('/Customer/EditContct/{id}', [GnCustomerController::class, 'EditContct']);
Route::post('/Customer/updatecontacts', [GnCustomerController::class, 'updatecontacts']);

//customer list
Route::get('/CustomerList/loadCustomers', [GnCustomerController::class, 'loadCustomers']);
Route::delete('/CustomerList/deleteCustomer/{id}', [GnCustomerController::class, 'deleteCustomer'])->middleware('can:st_customer_delete');

//customer attachments
Route::get('customers/all', [StCustomerAttachmentController::class, 'allCustomers']);
Route::get('SelectedCustomers/name/{id}', [StCustomerAttachmentController::class, 'SelectedCustomersName']);
Route::post('/attachment/upload', [StCustomerAttachmentController::class, 'upload'])->name('uploadcustomerAttachment')->middleware('can:st_customer_attachment_add');
Route::get('CustomerAttachment/allFiles/{id}', [StCustomerAttachmentController::class, 'allFiles']);
Route::get('/CustomerAttachment/delete/{id}', [StCustomerAttachmentController::class, 'delete'])->middleware('can:st_customer_attachment_delete');

/** Country */
Route::post('/countryListController/save', [CountryListController::class, 'save']);
Route::put('/countryListController/update/{id}', [CountryListController::class, 'update']);
Route::put('/countryListController/disable/{id}', [CountryListController::class, 'disable']);
Route::get('/countryListController/getCountry/{id}', [CountryListController::class, 'getCountry']);
Route::get('/countryListController/allCountries', [CountryListController::class, 'allCountries']);
/** End of Country */



/** Customer Order */
Route::get('/customerOrder/allCustomer', [CustomerOrderController::class, 'allCustomers']);
Route::get('/customerOrder/getCustomer/{id}', [CustomerOrderController::class, 'SelectedCustomersData']);
Route::get('/customerOrder/allCountries', [CustomerOrderController::class, 'allCountries']);
Route::get('/customerOrder/allShippingTerms', [CustomerOrderController::class, 'allShippingTerms']);
Route::get('/customerOrder/allDrainHoleSize', [CustomerOrderController::class, 'allDrainHoleSize']);
Route::get('/customerOrder/allDrainHoleShape', [CustomerOrderController::class, 'allDrainHoleShape']);
Route::get('/customerOrder/allProductMix', [CustomerOrderController::class, 'allProductMix']);
Route::get('/customerOrder/allWashedLevel', [CustomerOrderController::class, 'allWashedLevel']);
Route::get('/customerOrder/allOrderDataWithToken/{id}/{token}', [CustomerOrderController::class, 'allOrderDataWithToken']);
Route::get('/customerOrder/allOrderData/{id}', [CustomerOrderController::class, 'allOrderData']);
Route::get('/customerOrder/getCustomerAllOrderData/{id}', [CustomerOrderController::class, 'getCustomerAllOrderData']);
Route::get('/customerOrder/getCustomerOrderData/{id}', [CustomerOrderController::class, 'getCustomerOrderData']);
Route::get('/customerOrder/getCustomerMainOrder/{id}', [CustomerOrderController::class, 'getCustomerMainOrder']);
Route::get('/customerOrder/allAttachment/{id}', [CustomerOrderController::class, 'allAttachment']);
Route::post('/customerOrder/saveOrderData', [CustomerOrderController::class, 'saveOrderData']);
Route::post('/customerOrder/updateOrderData/{id}', [CustomerOrderController::class, 'updateOrderData']);
Route::post('/customerOrder/saveCustomerOrder', [CustomerOrderController::class, 'saveCustomerOrder']);
Route::post('/customerOrder/updateCustomerOrder/{id}', [CustomerOrderController::class, 'updateCustomerOrder']);

Route::delete('/customerOrder/deleteOrderData/{id}', [CustomerOrderController::class, 'deleteOrderData']);
Route::delete('/customerOrder/deleteAttachment/{id}', [CustomerOrderController::class, 'deleteAttachment']);
Route::post('/customerOrder/uploadAttachment', [CustomerOrderController::class, 'uploadAttachment']);
/** End Customer Order */


/** Customer Order List Controller */
Route::get('/customerOrderList/allCustomerOrder', [CustomerOrderListController::class, 'allCustomerOrder']);
/** End Of Customer Order List Controller */



/** Settings */
Route::post('/settings/shippingterm', [SettingsController::class, 'saveShippingTerm']);
Route::post('/settings/productmix', [SettingsController::class, 'saveProductMix']);
Route::post('/settings/washedlevel', [SettingsController::class, 'saveWashedLevel']);
Route::post('/settings/plantholesize', [SettingsController::class, 'savePlantHoleSize']);
Route::post('/settings/drainholesize', [SettingsController::class, 'saveDrainHoleSize']);
Route::post('/settings/drainholeshape', [SettingsController::class, 'saveDrainHoleShape']);
Route::post('/settings/productsize', [SettingsController::class, 'saveProductSize']);

Route::get('/settings/shippingterms', [SettingsController::class, 'allShippingTerm']);
Route::get('/settings/productmixes', [SettingsController::class, 'allProductMix']);
Route::get('/settings/washedlevels', [SettingsController::class, 'allWashedLevel']);
Route::get('/settings/plantholesizes', [SettingsController::class, 'allPlantHoleSize']);
Route::get('/settings/drainholesizes', [SettingsController::class, 'allDrainHoleSize']);
Route::get('/settings/drainholeshape', [SettingsController::class, 'allDrainHoleShape']);
Route::get('/settings/productsize', [SettingsController::class, 'allProductSize']);

Route::put('/settings/shippingterm/{id}', [SettingsController::class, 'updateShippingTerm']);
Route::put('/settings/productmix/{id}', [SettingsController::class, 'updateProductMix']);
Route::put('/settings/washedlevel/{id}', [SettingsController::class, 'updateWashedLevel']);
Route::put('/settings/plantholesize/{id}', [SettingsController::class, 'updatePlantHoleSize']);
Route::put('/settings/drainholesize/{id}', [SettingsController::class, 'updateDrainHoleSize']);
Route::put('/settings/drainholeshape/{id}', [SettingsController::class, 'updateDrainHoleShape']);
Route::put('/settings/productsize/{id}', [SettingsController::class, 'updateProductSize']);

Route::delete('/settings/shippingterm/{id}', [SettingsController::class, 'disableShippingTerm']);
Route::delete('/settings/productmix/{id}', [SettingsController::class, 'disableProductMix']);
Route::delete('/settings/washedlevel/{id}', [SettingsController::class, 'disableWashedLevel']);
Route::delete('/settings/plantholesize/{id}', [SettingsController::class, 'desablePlantHoleSize']);
Route::delete('/settings/drainholesize/{id}', [SettingsController::class, 'desableDrainHoleSize']);
Route::delete('/settings/drainholeshape/{id}', [SettingsController::class, 'desableDrainHoleShape']);
Route::delete('/settings/productsize/{id}', [SettingsController::class, 'desableProductSize']);

Route::delete('/settings/shippingterm/delete/{id}', [SettingsController::class, 'deleteShippingTerm']);
Route::delete('/settings/productmix/delete/{id}', [SettingsController::class, 'deleteProductMix']);
Route::delete('/settings/washedlevel/delete/{id}', [SettingsController::class, 'deleteWashedLevel']);
Route::delete('/settings/plantholesize/delete/{id}', [SettingsController::class, 'deletePlantHoleSize']);
Route::delete('/settings/drainholesize/delete/{id}', [SettingsController::class, 'deleteDrainHoleSize']);
Route::delete('/settings/drainholeshape/delete/{id}', [SettingsController::class, 'deleteDrainHoleShape']);
Route::delete('/settings/productsize/delete/{id}', [SettingsController::class, 'deleteProductSize']);
/** End Settings */



//login
Route::post('/login', [LogInController::class, 'login']);

Route::get('/loginApp/{email}/{password}', [LogInController::class, 'loginApp']);

Route::get('/loginTest', [LogInController::class, 'loginTest']);

//logout
Route::get('/logout', [LogInController::class, 'logout']);


  /** Customer Order Thread */
  Route::post('/customerOrderThread/submit', [CustomerOrderThreadController::class, 'submit']);
  Route::get('/customerOrderThread/loadCustomerOrderThread/{order_id}', [CustomerOrderThreadController::class, 'loadCustomerOrderThread']);
  /** End of Customer Order Thread  */