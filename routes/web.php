<?php

namespace App\Http\Controllers;

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

// Auth users
Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard");

    Route::get('/new_record', [NewOrderController::class, 'index'])->name('record.new');
    Route::post('/new_record', [NewOrderController::class, 'create']);
});

// Guest user
Route::middleware(['guest'])->group(function() {
    Route::get('/signup', [AuthController::class, 'getSignup'])->name("auth.signup");
    Route::post('/signup', [AuthController::class, 'postSignup']);

    Route::get('/signin', [AuthController::class, 'getSignin'])->name("auth.signin");
    Route::post('/signin', [AuthController::class, 'postSignin']);
});

// All users
Route::get('/', [HomeController::class, 'index'])->name("home");
Route::get('/signout', [AuthController::class, 'getSignout'])->name('auth.signout');



