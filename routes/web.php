<?php

use App\Http\Controllers\AuthController;
use App\Http\Livewire\Airfields\Index;
use App\Http\Livewire\LandingPage;
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

Route::get('/', LandingPage::class);

Route::middleware('guest')->group(function () {
    Route::get('/auth/login', [AuthController::class, 'redirect'])->name('auth.login');
    Route::get('/auth/login/callback', [AuthController::class, 'callback'])->name('auth.login.callback');
});

Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
