<?php

use App\Http\Controllers\GoogleAuthController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/google',[GoogleAuthController::class,'loginWithGoogle'])->name('google-auth');

Route::get('auth/google/call-back',[GoogleAuthController::class,'callbackfromgoogle'])->name('google-callBack');

Route::get('google/index',[GoogleAuthController::class,'index'])->name('google.home');

Auth::routes();