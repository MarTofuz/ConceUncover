<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;


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
    return view('auth.landing');
})->name('/');


Route::group(['prefix' => '/login'], function(){
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/', [AuthController::class, 'attemptLogin'])->name('login.attempt');
});

Route::group(['prefix' => '/register'], function(){
    Route::get('/', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/', [AuthController::class, 'storeAccount'])->name('register.store');
});
Route::group(['prefix' => '/restpass'], function(){
    Route::get('/', [AuthController::class, 'restpass'])->name('restpass');
    Route::post('/', 'AuthController@restablecerContrasena')->name('restpass.attempt');
});

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/landing', [AuthController::class, 'landing'])->name('landing');

Route::get('/restcode', [AuthController::class, 'restcode'])->name('restcode');

Route::get('/newpass', [AuthController::class, 'newpass'])->name('newpass');



