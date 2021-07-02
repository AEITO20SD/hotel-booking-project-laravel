<?php

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
    return view('index');
})->name('home');

Route::get('/hotel-facilities', function () {
    return view('hotel_facilities');
})->name('hotel_facilities');

// login routes
Route::get('/admin', 'LoginController@index')->name('admin_login_get');
Route::post('/admin', 'LoginController@attemptLogin')->name('admin_login_post');
Route::post('/admin-logout', 'LoginController@logout')->name('admin_logout');

Route::get('/rooms', 'RoomController@index')->name('rooms.index');
Route::get('/rooms/{room}', 'RoomController@show')->name('rooms.show');
Route::get('/bookings', 'BookingController@index')->name('bookings.index');
Route::post('/bookings/set-email', 'BookingController@setClientEmail')->name('bookings.set_email');

Route::middleware('auth')->resource('room', RoomController::class)->except('show', 'index');
// Route::resource('bookings', BookingController::class);
Route::resource('room.bookings', BookingController::class)->except('index');
