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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/home/{id}', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::post('/home/reporte_tickets', [App\Http\Controllers\PDFReporteTicketsController::class, 'index'])->name('reporte_tickets')->middleware('auth');
Route::get('/correoPrueba', [App\Http\Controllers\HomeController::class, 'show'])->name('show')->middleware('auth');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/confirmar-reasignacion/{id}', [App\Http\Controllers\mailConnectionController::class, 'show'])->middleware('auth');
Route::get('/inventario/resguardo/{id}', [App\Http\Controllers\PDFResguardoController::class, 'show'])->middleware('auth');
Route::get('/inventario/generar_reporte/{id}', [App\Http\Controllers\PDFInventarioController::class, 'index'])->middleware('auth');
Route::get('/inventario/generar_filtros/{id}', [App\Http\Controllers\InventariosController::class, 'getfiltros'])->middleware('auth');
Route::get('/inventario/generar_reporte_filtros/{empresa_id}/{area}/{puesto}/{ucoip}', [App\Http\Controllers\PDFInventarioController::class, 'reporte_filtros']);

Route::resource('tickets', TicketsController::class)->middleware('auth');
Route::resource('estatus', EstatusController::class)->middleware('auth');
Route::resource('areas', AreasController::class)->middleware('auth');
Route::resource('usuarios', UserController::class)->middleware('auth');
Route::resource('inventario', InventariosController::class)->middleware('auth');
