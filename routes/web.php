<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUserController;

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
    return view('welcome');
});

Route::resource('registerusers', RegisterUserController::class);
// Route::post('active', RegisterUserController::class, 'active')->name('active');
Route::post('active/{id}', [RegisterUserController::class, 'active'])->name('registerusers.active');
Route::get('login', [RegisterUserController::class, 'login'])->name('registerusers.login');
