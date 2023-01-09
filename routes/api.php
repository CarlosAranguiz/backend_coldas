<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\PracticaController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login',[UserController::class,'loginApi'])->name('api.login');
Route::post('registro',[UserController::class,'registroAlumno'])->name('api.registro');

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('practica-activa',[PracticaController::class,'practicaActiva'])->name('practica_activa');
    Route::get('historial-practica',[PracticaController::class,'obtenerHistorial'])->name('historial_practica');
    Route::post('marcar-asistencia',[PracticaController::class,'marcarAsistencia'])->name('marcar_asistencia');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('carrera/{id}',[ApiController::class,'carrera'])->name('api.carreras.universidad');