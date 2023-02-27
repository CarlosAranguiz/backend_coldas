<?php

use App\Http\Controllers\CarreraController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\UniversidadController;
use App\Http\Controllers\UserController;
use App\Models\Subcategoria;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/',[HomeController::class,'index'])->name('/');
Route::get('/login',[UserController::class,'loginView'])->name('loginview');
Route::post('/login',[UserController::class,'login'])->name('loginpost');

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
        });

        Route::prefix('historial')->group(function (){
            Route::get('/',[HistorialController::class,'index'])->name('historial.list');
            Route::post('/liberar',[HistorialController::class,'limpiarDispositivo'])->name('historial.limpiar');
        });

        Route::prefix('categorias')->group(function (){
            Route::get('/',[SubcategoriaController::class,'index'])->name('categorias.list');
            Route::post('/',[SubcategoriaController::class,'store'])->name('categorias.store');
        });

        Route::prefix('publicaciones')->group(function(){
            Route::get('/',[PublicacionController::class,'index'])->name('publicaciones.list');
            Route::post('/',[PublicacionController::class,'store'])->name('publicaciones.add');
        });
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