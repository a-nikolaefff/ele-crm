<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerTypeController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');
    Route::get('profile', [ProfileController::class, 'index'])
        ->name('profile');
});

Route::middleware(['auth', 'verified', 'authorized'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('customer-types', CustomerTypeController::class);
    Route::get('customers/autocomplete', [CustomerController::class, 'autocomplete']);
    Route::resource('customers', CustomerController::class);
    Route::resource('requests', RequestController::class);

});


