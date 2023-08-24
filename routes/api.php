<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\InformacionUtilController;
use App\Http\Controllers\InscritoEventoController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostEventAnswerController;
use App\Http\Controllers\PracticaController;
use App\Http\Controllers\PreguntasController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\UserController;
use App\Models\InscritoEvento;
use App\Models\PostEventAnswer;
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

Route::post('login',[ApiController::class,'loginApi'])->name('api.login');
Route::post('registro',[ApiController::class,'registroAlumno'])->name('api.registro');
Route::get('categorias/{tema}',[SubcategoriaController::class,'listadoPorTema'])->name('api.listaportema');

Route::get('publicaciones/{subcategoria}',[PublicacionController::class,'listado'])->name('publi.listado.categoria');
Route::get('recursos',[PublicacionController::class,'listadoRecursos'])->name('recursos.listado');
Route::post('recursos/buscar',[PublicacionController::class,'buscarRecurso'])->name('recursos.buscar');

Route::get('posts',[PostController::class,'getPosts'])->name('api.post');
Route::post('posts/buscar',[PostController::class,'buscarPosts'])->name('api.post.buscar');
Route::get('eventos',[EventoController::class,'getEventos'])->name('api.eventos');
Route::get('decalogo',[InformacionUtilController::class,'getDecalogo'])->name('api.decalogo');
Route::get('links',[LinkController::class,'getLinks'])->name('api.links');

Route::get('evaluacion',[PreguntasController::class,'getPreguntasEvaluacion'])->name('api.preguntas.evaluacion');

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('practica-activa',[PracticaController::class,'practicaActiva'])->name('practica_activa');
    Route::get('historial-practica',[PracticaController::class,'obtenerHistorial'])->name('historial_practica');
    Route::post('marcar-asistencia',[PracticaController::class,'marcarAsistencia'])->name('marcar_asistencia');
    Route::post('subir-imagen',[ApiController::class,'subirImagen'])->name('api.subirimagen');
    Route::post('eliminar-cuenta',[ApiController::class,'eliminar_cuenta'])->name('api.eliminarcuenta');
    Route::get('preguntas',[PreguntasController::class,'getPreguntas'])->name('api.preguntas');
    Route::post('terminar-prueba',[PreguntasController::class,'terminar_prueba'])->name('api.terminarprueba');
    Route::post('terminar-prueba-evaluacion',[PreguntasController::class,'terminar_prueba_evaluacion'])->name('api.terminarpruebaevaluacion');
    Route::post('eventos/inscribirme',[InscritoEventoController::class,'store'])->name('api.inscribirme');
    Route::post('terminar-evaluacion-evento',[PostEventAnswerController::class,'terminar_prueba_evaluacion'])->name('api.terminarevento');
    Route::post('eventos/comprobar',[EventoController::class,'comprobarEvento'])->name('api.comprobarEvento');
});

Route::post('contacto',[ContactoController::class,'store'])->name('api.contacto');
Route::get('nosotros',[NosotrosController::class,'getNosotros'])->name('api.nosotros');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('carrera/{id}',[ApiController::class,'carrera'])->name('api.carreras.universidad');

