<?php

use App\Http\Controllers\CarreraController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ConveniosController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformacionUtilController;
use App\Http\Controllers\InscritoEventoController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostEventQuestionController;
use App\Http\Controllers\PostEventQuestionOptionController;
use App\Http\Controllers\PracticaController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\UniversidadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/',[HomeController::class,'index'])->name('/');
Route::get('/login',[UserController::class,'loginView'])->name('loginview');
Route::post('/login',[UserController::class,'login'])->name('loginpost');


Route::get('politicas', [HomeController::class,'politicas'])->name('politicas');

Route::get('prueba-informe',[InformacionUtilController::class,'prueba'])->name('prueba.informa');


Route::group(['middleware' => 'auth:sanctum'],function (){
    Route::get('/',[HomeController::class,'index'])->name('dashboard');
    Route::prefix('admin')->group(function () {
        Route::get('alumnos',[UserController::class,'alumnos'])->name('alumnos.list');
        Route::post('alumnos/importar',[UserController::class,'importAlumnos'])->name('alumnos.importar');
        Route::get('alumnos/add',[UserController::class,'storeForm'])->name('alumnos.form.create');
        Route::post('alumnos',[UserController::class,'store'])->name('alumnos.create');
        Route::get('alumnos/{id}',[UserController::class,'userdetail'])->name('alumnos.detalle');
        Route::post('alumnos/{id}',[UserController::class,'update'])->name('alumnos.update');
        Route::post('delete/alumnos/',[UserController::class,'delete'])->name('alumnos.delete');
        Route::post('practica/asignar-alumno',[PracticaController::class,'crear_practica'])->name('alumnos.asignar_practica');

        Route::prefix('universidades')->group(function () {
            Route::get('/',[UniversidadController::class,'index'])->name('universidad.list');
            Route::post('/add',[UniversidadController::class,'store'])->name('universidad.store');
            Route::get('/{id}',[UniversidadController::class,'show'])->name('universidad.detalle');
            Route::post('/importar',[UniversidadController::class,'importUniversidades'])->name('universidad.import');
        });

        Route::prefix('carrera')->group(function (){
            Route::post('/add',[CarreraController::class,'store'])->name('carrera.store');
            Route::post('/delete',[CarreraController::class,'delete'])->name('carrera.delete');
        });

        Route::prefix('codigos')->group(function (){
            Route::get('/',[QRController::class,'index'])->name('codigos.list');
            Route::get('/{id}',[QRController::class,'verQR'])->name('codigos.ver');
            Route::post('/add',[QRController::class,'store'])->name('codigos.crear');
            Route::post('/eliminar-codigo',[QRController::class,'eliminarQR'])->name('codigos.eliminar');
        });

        Route::prefix('historial')->group(function (){
            Route::get('/',[HistorialController::class,'index'])->name('historial.list');
            Route::post('/liberar',[HistorialController::class,'limpiarDispositivo'])->name('historial.limpiar');
        });

        Route::prefix('categorias')->group(function (){
            Route::get('/',[SubcategoriaController::class,'index'])->name('categorias.list');
            Route::post('/',[SubcategoriaController::class,'store'])->name('categorias.store');
            Route::post('/eliminar-categoria',[SubcategoriaController::class,'eliminar_categorias'])->name('categorias.eliminar');
        });

        Route::prefix('publicaciones')->group(function(){
            Route::get('/',[PostController::class,'index'])->name('publicaciones.list');
            Route::get('crear',[PostController::class,'create'])->name('publicaciones.create');
            Route::post('/',[PostController::class,'store'])->name('publicaciones.add');
            Route::get('/edit/{id}',[PostController::class,'edit'])->name('publicaciones.edit');
            Route::post('/edit/{id}',[PostController::class,'update'])->name('publicaciones.update');
            Route::get('/eliminar/{id}',[PostController::class,'delete'])->name('publicaciones.delete');
        });

        Route::prefix('recursos')->group(function(){
            Route::get('/',[PublicacionController::class,'index'])->name('recursos.list');
            Route::post('/',[PublicacionController::class,'store'])->name('recursos.store');
            Route::post('/eliminar',[PublicacionController::class,'delete'])->name('recursos.delete');
        });

        Route::prefix('eventos')->group(function() {
            Route::get('/',[EventoController::class,'index'])->name('eventos.list');
            Route::post('/crear',[EventoController::class,'store'])->name('eventos.store');
            Route::get('/eliminar/{id}',[EventoController::class,'destroy'])->name('eventos.eliminar');
            Route::get('/{id}/inscritos',[InscritoEventoController::class,'index'])->name('eventos.inscritos');
            Route::get('/{id}/excel',[EventoController::class,'excelExport'])->name('eventos.excel');
        });

        Route::prefix('contactos')->group(function(){
            Route::get('/',[ContactoController::class,'index'])->name('contactos.list');
        });

        Route::prefix('nosotros')->group(function(){
            Route::get('/',[NosotrosController::class,'index'])->name('nosotros.list');
            Route::post('/',[NosotrosController::class,'store'])->name('nosotros.store');
            Route::get('store',[NosotrosController::class,'create'])->name('nosotros.create');
            Route::get('/eliminar/{id}',[NosotrosController::class,'delete'])->name('nosotros.delete');
        });

        Route::prefix('convenios')->group(function(){
            Route::get('/',[ConveniosController::class,'index'])->name('convenios.list');
            Route::post('/',[ConveniosController::class,'store'])->name('convenios.store');
            Route::get('/eliminar/{id}',[ConveniosController::class,'destroy'])->name('convenios.eliminar');
        });

        Route::prefix('links')->group(function(){
            Route::get('/',[LinkController::class,'index'])->name('links.list');
            Route::post('/',[LinkController::class,'store'])->name('links.store');
            Route::get('/eliminar/{id}',[LinkController::class,'destroy'])->name('links.eliminar');
        });

        Route::get('event-questions/{evento}',[PostEventQuestionController::class,'index'])->name('posteventquestions.index');
        Route::get('event-questions/{id}/options',[PostEventQuestionController::class,'show'])->name('posteventquestions.show');
        Route::get('event-questions/option/{id}/destroy',[PostEventQuestionOptionController::class,'destroy'])->name('posteventoptions.destroy');
        Route::resource('posteventquestions', PostEventQuestionController::class)->except(['index','show']);

        Route::resource('posteventoptions',PostEventQuestionOptionController::class)->except(['destroy']);

        Route::post('guardar-decalogo',[InformacionUtilController::class,'SaveDecalogo'])->name('guardar.decalogo');
        Route::get('config',[InformacionUtilController::class,'index'])->name('config');
        Route::get('informes',[InformacionUtilController::class,'Informes'])->name('informes');
        Route::get('informes/{id}',[InformacionUtilController::class,'informesExcel'])->name('informes.excel');
    });
});



Route::get('lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'de', 'es','fr','pt', 'cn', 'ae'])) {
        abort(400);
    }
    Session()->put('locale', $locale);
    Session::get('locale');
    return redirect()->back();
})->name('lang');

Route::prefix('dashboard')->group(function () {
    Route::view('index', 'dashboard.index')->name('index');
    Route::view('dashboard-02', 'dashboard.dashboard-02')->name('dashboard-02');
});

Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');

Route::get('/artisan-migrate', function (){
    Artisan::call('migrate');
});

Route::get('/storage-link', function (){
    Artisan::call('storage:link');
    return redirect()->route('dashboard');
});
