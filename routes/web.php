<?php

use App\Http\Controllers\changePWController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\staffAcctController;
use App\Http\Controllers\monthlypayController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\staffOrderController;

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
//  for customer 
Auth::routes();

//for upload comm inv
Route::get('preview-image-upload', 'simple_image_upload\ImageUploadController@index');
Route::post('preview-image-upload', 'simple_image_upload\ImageUploadController@store');

Route::get('/', 'OrderController@viewOrderCust')->name('home')->middleware('auth');
Route::get('/home','OrderController@viewOrderCust')->name('home');

//customer change password
Route::get('change-password', 'ChangePWController@index');
Route::post('change-password', 'ChangePWController@store')->name('change.password');

Route::group(['middleware' => 'auth:web'], function () {

//customer account management
Route::get('/profile/{user}/edit', 'profileController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'profileController@update')->name('profile.update');

// View all order
Route::get('orders/viewAll','OrderController@viewOrderCust')->name('orders.custView');

//duplicate order 
Route::get('orders/duporder/{order}', 'OrderController@duporder')->name('order.duporder');
Route::post('orders/updateorderb/{order}', 'OrderController@updateorderb')->name('orders.orderorder');

//Monthly payment
Route::get('settlepayment/{order}', 'monthlypayController@settlepay')->name('settlepay.view');
Route::post('settlepayment/{order}/success','monthlypayController@success')->name('settlepay.success');
Route::get('monthlypay','monthlypayController@view')->name('monthlypay.view');


});

Route::group(['middleware' => 'auth:web,staff'], function () {

    //order
    Route::get('/show_vehicle', 'VehicleController@showVehicle');
    Route::get('orders/createorderwithdetails', 'OrderController@createorderwithdetails')->name('orders.createorderwithdetails');
    Route::post('orders/storewithdetails', 'OrderController@storewithdetails')->name('orders.storewithdetails');
    Route::get('orderdetails/calfee','OrderDetailController@calfee')->name('orders.calfee');
    Route::resource('orders', 'OrderController');
    Route::resource('orderdetails', 'OrderDetailController');
    Route::post('/posts/confirmation', 'PostController@confirmation');

    // Track shipment
    Route::get('/live_search', 'LiveSearch@index');
    Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');
    

    //for print airwaybill
    Route::resource('airwaybill', 'airwaybillController');

    //for print commercialinvoice
     Route::resource('commercialinvoice', 'CommercialinvoiceController');

    //View Monthly Payment
   

   Route::get('viewOrderDetail/{order}','orderController@viewOrderDetail')->name('order.viewDetail');

  

});




//  for staff 

Route::get('staff/login', [staffController::class, 'login'])
    ->name('staff.login');

Route::post('staff/login', [staffController::class, 'handleLogin'])
    ->name('staff.handleLogin');

Route::get('staff/logout', [staffController::class, 'login'])
    ->name('staff.logout');

Route::post('staff/logout', [staffController::class, 'logout'])
    ->name('staff.logout');

Route::group(['middleware' => 'auth:staff'], function () 
{

    Route::get('staff/', [staffOrderController::class, 'view'])
        ->name('staff.home');


    //staff Account
    Route::get('staff/staffacct', 'staffAcctController@index')->name('staffacct.index');
    Route::get('staff/staffacct/create', 'staffAcctController@create')->name('staffacct.create');
    Route::post('staff/staffacct/store', 'staffAcctController@store')->name('staffacct.store');
    Route::get('staff/staffacct/{staff}/edit', 'staffAcctController@edit')->name('staffacct.edit');
    Route::patch('staff/staffacct/{staff}', 'staffAcctController@update')->name('staffacct.update');
    Route::delete('staff/staffacct/{staff}', 'staffAcctController@destroy')->name('staffacct.delete');
    Route::get('staff/staffacct/search', 'staffAcctController@getstaff')->name('staffacct.earch');
      
    


    //customer account management  Staff side
    Route::view('staff/profile/create', 'profile.create')->name('profile.custStaffcreate');
    Route::post('staff/profile/store', 'profileController@storeCustomer')->name('profile.custStaffsore');
    Route::get('staff/profile/all', 'profileController@viewAll')->name('profile.custStaffviewAll');
    Route::get('staff/profile/{user}', 'profileController@show')->name('profile.custStaffshow');
    Route::get('staff/profile/{user}/edit', 'profileController@editCustomer')->name('profile.custStaffedit');
    Route::patch('staff/profile/{user}', 'profileController@updateCustomer')->name('profile.custStaffupdate');
    Route::delete('staff/profile/{user}', 'profileController@destroy')->name('profile.custStaffdelete');
    
    Route::get('staff/viewMonPay','monthlypayController@staffView')->name('staff.monthlyView');
    Route::post('staff/viewMonPay/{order}','monthlypayController@paymentconfirm')->name('staff.monthlyConfirm');

    Route::get('staff/orderindex','staffOrderController@view')->name('staff.orderindex');
    Route::get('staff/orderedit/{order}', 'staffOrderController@edit')->name('staff. orderedit');
    Route::post('staff/updateorder/{order}', 'staffOrderController@updateorder')->name('staff.orderorder');
    Route::get('staff/ordersearch','staffOrderController@search')->name('staff.search');


    Route::get('staff/viewbooking','staffOrderController@viewbooking')->name('staff.viewbooking');
    Route::get('staff/editbooking/{booking}','staffOrderController@editbooking')->name('staff.editbooking');
    Route::post('staff/updatebooking/{booking}','staffOrderController@updatebooking')->name('staff.updatebooking');
   
});
