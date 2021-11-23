<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GestionUsuarioController;
use App\Http\Controllers\OrderController;


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
})->name('home');

Route::middleware('auth')->group( function () {
    Route::resource('orders', OrderController::class)->except([
     'update'
]);

    Route::post('/cierre_sesion', [GestionUsuarioController::class, 'cierre_sesion'])->name('logout');

    Route::post('/orders/agregar_producto', [OrderController::class, 'agregar_producto']);

    Route::post('/orders/update/{id}', [OrderController::class, 'update'])->name('orders.update');

    Route::get('/usuarios/lista/', [GestionUsuarioController::class, 'index'])->name('usuarios.index');

    Route::get('/carga_archivos', [\App\Http\Controllers\CargaArchivoController::class, 'index'])->name('carga_archivo.index');

    Route::post('/carga_archivos/carga', [\App\Http\Controllers\CargaArchivoController::class, 'carga'])->name('carga_archivo.carga');
});

Route::get('/registro', [GestionUsuarioController::class, 'registro'])->name('register');

Route::get('/login', [GestionUsuarioController::class, 'login'])->name('login');

Route::get('/sesion/{id}', [GestionUsuarioController::class, 'inicio_sesion'])->name('sesion_inicio');



