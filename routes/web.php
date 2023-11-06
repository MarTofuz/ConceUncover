<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SucursalController;


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

Route::get('/',[LandingController::class, 'index'], function () {return view('auth.landing');})->name('/');

Route::group(['prefix' => '/login'], function(){
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/', [AuthController::class, 'attemptLogin'])->name('login.attempt');
});

Route::group(['prefix' => '/register'], function(){
    Route::get('/', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/', [AuthController::class, 'storeAccount'])->name('register.store');
});
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



//user normal

Route::group(['prefix' => '/profile'], function(){
    Route::get('/', [AdminController::class, 'profile'])->name('profile')->middleware('auth');
    Route::post('/', [AdminController::class, 'update'])->name('update')->middleware('auth');
});

Route::get('/profile/edit', [AdminController::class, 'edit'])->name('edit');


Route::group(['prefix' => '/editShop'], function(){
    Route::get('/', [TiendaController::class, 'viewSaveShop'])->name('viewSaveShop')->middleware('auth');
    Route::post('/', [TiendaController::class, 'saveShop'])->name('saveShop')->middleware('auth');
});

Route::group(['prefix' => '/editLocal'], function(){
    Route::get('/', [TiendaController::class, 'viewupdateshop'])->name('viewupdateshop')->middleware('auth');
    Route::post('/', [TiendaController::class, 'updateShop'])->name('updateShop')->middleware('auth');
});

Route::get('/profileShop', [TiendaController::class, 'viewProfileShop'])->name('viewProfileShop')->middleware('auth');

Route::group(['prefix' => '/saveSucursal/{id}'], function(){
    Route::get('/', [SucursalController::class, 'viewSaveSucursal'])->name('viewSaveSucursal')->middleware('auth');
    Route::post('/', [SucursalController::class, 'saveSucursal'])->name('saveSucursal')->middleware('auth');
});

Route::get('/profileShop/{id}', [SucursalController::class, 'deletedSucursal'])->name('deletedSucursal')->middleware('auth');

Route::group(['prefix' => '/editSucursal/{id}'], function(){
    Route::get('/', [SucursalController::class, 'viewUpdateSucursal'])->name('viewUpdateSucursal')->middleware('auth');
    Route::post('/', [SucursalController::class, 'updateSucursal'])->name('updateSucursal')->middleware('auth');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('/adminPanel', [AdminController::class, 'adminPanel'])->name('adminPanel')->middleware(['auth','CheckIsAdmin']);

Route::get('/adminAccount', [AdminController::class, 'adminAccount'])->name('adminAccount')->middleware('auth','CheckIsAdmin');
Route::get('/eliminar-usuario/{id}', [AdminController::class, 'eliminarUsuario'])->name('eliminar-usuario')->middleware('auth', 'CheckIsAdmin');


Route::get('/adminStore', [AdminController::class, 'adminStore'])->name('adminStore')->middleware('auth','CheckIsAdmin');
Route::get('/eliminar-sucursal/{id}', [AdminController::class, 'eliminarSucursal'])->name('eliminar-sucursal')->middleware('auth', 'CheckIsAdmin');
Route::get('/eliminar-tienda/{id}', [AdminController::class, 'eliminarTienda'])->name('eliminar-tienda')->middleware('auth', 'CheckIsAdmin');

Route::get('delay-page', function () {
    return view('delay-page');
})->name('showDelayPage');

Route::group(['prefix' => '/adminAccount'], function(){
    Route::get('/', [AdminController::class, 'adminAccount'])->name('adminAccount')->middleware('auth','CheckIsAdmin');
    Route::get('/buscar-usuario', [AdminController::class, 'buscarUsuario'])->name('buscarUsuario');
});

Route::group(['prefix' => '/adminStore'], function(){
    Route::get('/', [AdminController::class, 'adminStore'])->name('adminStore')->middleware('auth','CheckIsAdmin');
    Route::get('/buscar-tienda', [AdminController::class, 'buscarTienda'])->name('buscarTiendas');
});
