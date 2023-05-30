<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

Route::get(
    '/dashboard',
    [App\Http\Controllers\DashboardController::class, 'index']
)
    ->name('dashboard');


Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'index'])
    ->name('profile');

Route::resource(
    'requests',
    \App\Http\Controllers\EquipmentRequestController::class
);

Route::resource('customers', \App\Http\Controllers\CustomerController::class);

Route::resource('customer-types', \App\Http\Controllers\CustomerTypeController::class);

Route::resource('users', \App\Http\Controllers\UserController::class);




