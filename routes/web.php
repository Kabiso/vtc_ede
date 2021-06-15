<?php

use App\Http\Controllers\changePWController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\staffAcctController;


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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('change-password', 'ChangePWController@index');
Route::post('change-password', 'ChangePWController@store')->name('change.password');

Route::get('/profile/{user}/edit', 'profileController@edit')->name('profile.edit');
Route::patch('/profile/{user}', 'profileController@update')->name('profile.update');



Route::group(['middleware' => 'auth'], function () {
    //order
    Route::get('/show_vehicle', 'VehicleController@showVehicle');
    Route::get('orders/createorderwithdetails', 'OrderController@createorderwithdetails')->name('orders.createorderwithdetails');
    Route::post('orders/storewithdetails', 'OrderController@storewithdetails')->name('orders.storewithdetails');

    Route::resource('orders', 'OrderController');
    Route::resource('orderdetails', 'OrderDetailController');
    Route::post('/posts/confirmation', 'PostController@confirmation');
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

    Route::get('staff/', [staffController::class, 'index'])
        ->name('staff.home');

    Route::view('staff/dashboard', 'staff.dashboard');


    //staff Account
    Route::get('staff/staffacct', 'staffAcctController@index')->name('staffacct.index');
    Route::get('staff/staffacct/create', 'staffAcctController@create')->name('staffacct.create');
    Route::post('staff/staffacct/store', 'staffAcctController@store')->name('staffacct.store');
    Route::get('staff/staffacct/{staff}/edit', 'staffAcctController@edit')->name('staffacct.edit');
    Route::patch('staff/staffacct/{staff}', 'staffAcctController@update')->name('staffacct.update');
    Route::delete('staff/staffacct/{staff}', 'staffAcctController@destroy')->name('staffacct.delete');
});
