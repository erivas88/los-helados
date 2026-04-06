<?php

use App\Http\Controllers\CargaDatosController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/carga-datos', function () {
        return view('modules.carga-datos');
    });

    Route::get('/control-calidad', function () {
        return view('modules.control-calidad');
    });

    Route::get('/visualizacion', function () {
        return view('modules.visualizacion');
    });

    Route::get('/graficos', function () {
        return view('modules.graficos');
    });

    Route::get('/api/carga-datos/columns', [CargaDatosController::class, 'getColumns']);
    Route::get('/api/carga-datos/filters', [CargaDatosController::class, 'getFilterData']);
    Route::get('/api/carga-datos/estaciones/{id_sector}', [CargaDatosController::class, 'getEstacionesBySector']);
    Route::post('/api/carga-datos/filtrar', [CargaDatosController::class, 'filtrarMuestras']);
    Route::post('/api/carga-datos/eliminar', [CargaDatosController::class, 'eliminarMuestras']);
    Route::post('/muestras/importar', [CargaDatosController::class, 'importar']);
});
