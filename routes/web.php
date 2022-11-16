<?php

use App\Http\Controllers\TicketsController;
use App\Http\Controllers\EstatusController;
use App\Http\Controllers\AreasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventariosController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/confirmar-reasignacion/{id}', [App\Http\Controllers\mailConnectionController::class, 'show']);
Route::get('/inventario/resguardo/{id}', [App\Http\Controllers\PDFResguardoController::class, 'show']);

Route::resource('tickets', TicketsController::class);
Route::resource('estatus', EstatusController::class);
Route::resource('areas', AreasController::class);
Route::resource('usuarios', UserController::class);
Route::resource('inventario', InventariosController::class);
