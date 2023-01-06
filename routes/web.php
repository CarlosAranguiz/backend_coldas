<?php

use App\Http\Controllers\CarreraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\UniversidadController;
use App\Http\Controllers\UserController;
use App\Models\Universidad;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::prefix('page-layouts')->group(function () {
    Route::view('box-layout', 'page-layout.box-layout')->name('box-layout');    
    Route::view('layout-rtl', 'page-layout.layout-rtl')->name('layout-rtl');    
    Route::view('layout-dark', 'page-layout.layout-dark')->name('layout-dark');    
    Route::view('hide-on-scroll', 'page-layout.hide-on-scroll')->name('hide-on-scroll');    
    Route::view('footer-light', 'page-layout.footer-light')->name('footer-light');    
    Route::view('footer-dark', 'page-layout.footer-dark')->name('footer-dark');    
    Route::view('footer-fixed', 'page-layout.footer-fixed')->name('footer-fixed');    
}); 

Route::view('sample-page', 'pages.sample-page')->name('sample-page');
Route::view('landing-page', 'pages.landing-page')->name('landing-page');

Route::prefix('others')->group(function () {
    Route::view('400', 'errors.400')->name('error-400');
    Route::view('401', 'errors.401')->name('error-401');
    Route::view('403', 'errors.403')->name('error-403');
    Route::view('404', 'errors.404')->name('error-404');
    Route::view('500', 'errors.500')->name('error-500');
    Route::view('503', 'errors.503')->name('error-503');
});

Route::prefix('layouts')->group(function () {
    Route::view('compact-sidebar', 'admin_unique_layouts.compact-sidebar'); //default //Dubai
    Route::view('box-layout', 'admin_unique_layouts.box-layout');    //default //New York //
    Route::view('dark-sidebar', 'admin_unique_layouts.dark-sidebar');

    Route::view('default-body', 'admin_unique_layouts.default-body');
    Route::view('compact-wrap', 'admin_unique_layouts.compact-wrap');
    Route::view('enterprice-type', 'admin_unique_layouts.enterprice-type');

    Route::view('compact-small', 'admin_unique_layouts.compact-small');
    Route::view('advance-type', 'admin_unique_layouts.advance-type');
    Route::view('material-layout', 'admin_unique_layouts.material-layout');

    Route::view('color-sidebar', 'admin_unique_layouts.color-sidebar');
    Route::view('material-icon', 'admin_unique_layouts.material-icon');
    Route::view('modern-layout', 'admin_unique_layouts.modern-layout');
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