<?php

use App\Http\Controllers\changePWController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\profileController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('change-password', 'ChangePWController@index');
Route::post('change-password', 'ChangePWController@store')->name('change.password');

Route::get('/profile/{user}/edit', 'profileController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'profileController@update')->name('profile.update');


//order

Route::get('/show_vehicle', 'VehicleController@showVehicle');
Route::get('orders/createorderwithdetails', 'OrderController@createorderwithdetails')->name('orders.createorderwithdetails');
Route::post('orders/storewithdetails', 'OrderController@storewithdetails')->name('orders.storewithdetails');

Route::resource('orders', 'OrderController'); 
Route::resource('orderdetails', 'OrderDetailController');
Route::post('/posts/confirmation', 'PostController@confirmation'); 



//  for staff 

Route::get('staff/login', [staffController::class, 'login'])
    ->name('staff.login');

Route::post('staff/login', [staffController::class, 'handleLogin'])
    ->name('staff.handleLogin');

Route::get('staff/logout', [staffController::class, 'index'])
    ->name('staff.logout');

Route::group(['middleware' => 'auth:staff'], function () {
        
    Route::get('staff/', [staffController::class, 'index'])
    ->name('staff.home');

    Route::view('staff/dashboard', 'staff.dashboard') -> middleware('auth:staff');
});


 


