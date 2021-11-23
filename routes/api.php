<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('user', [UserController::class,'user'])->middleware('auth:sanctum');

Route::post('/guardar', [UserController::class, 'store']);

Route::post('/iniciar_sesion', [UserController::class, 'authenticate']);

Route::get('/usuarios', [UserController::class, 'index'])->name('api.users');