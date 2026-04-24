<?php

use App\Http\Controllers\CargaDatosController;
use App\Http\Controllers\ControlCalidadController;
use App\Http\Controllers\VisualizacionController;
use App\Http\Controllers\EstacionesProyectoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::any('/', function () {
    return redirect('/inicio');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission:dashboard');
    Route::get('/api/dashboard/summary', [DashboardController::class, 'getSummary'])->middleware('permission:dashboard');

    Route::get('/inicio', function () {
        return view('modules.inicio');
    })->name('inicio')->middleware('permission:inicio');

    Route::get('/carga-datos', function () {
        return view('modules.carga-datos');
    })->middleware('permission:carga-datos');

    Route::get('/control-calidad', function () {
        return view('modules.control-calidad');
    })->middleware('permission:control-calidad');

    Route::get('/visualizacion', function () {
        return view('modules.visualizacion');
    })->middleware('permission:visualizacion');

    Route::get('/graficos', function () {
        return view('modules.graficos');
    })->middleware('permission:graficos');

    Route::get('/api/carga-datos/columns', [CargaDatosController::class, 'getColumns'])->middleware('permission:carga-datos');
    Route::get('/api/carga-datos/filters', [CargaDatosController::class, 'getFilterData'])->middleware('permission:carga-datos');
    Route::get('/api/carga-datos/estaciones/{id_sector}', [CargaDatosController::class, 'getEstacionesBySector'])->middleware('permission:carga-datos');
    Route::post('/api/carga-datos/filtrar', [CargaDatosController::class, 'filtrarMuestras'])->middleware('permission:carga-datos');
    Route::post('/api/carga-datos/eliminar', [CargaDatosController::class, 'eliminarMuestras'])->middleware('permission:carga-datos');
    Route::post('/muestras/importar', [CargaDatosController::class, 'importar'])->middleware('permission:carga-datos');

    Route::get('/api/control-calidad/columns', [ControlCalidadController::class, 'getColumns'])->middleware('permission:control-calidad');
    Route::get('/api/control-calidad/filters', [ControlCalidadController::class, 'getFilterData'])->middleware('permission:control-calidad');
    Route::get('/api/control-calidad/estaciones/{id_sector}', [ControlCalidadController::class, 'getEstacionesBySector'])->middleware('permission:control-calidad');
    Route::post('/api/control-calidad/filtrar', [ControlCalidadController::class, 'filtrarMuestras'])->middleware('permission:control-calidad');
    Route::post('/api/control-calidad/eliminar', [ControlCalidadController::class, 'eliminarMuestras'])->middleware('permission:control-calidad');
    Route::post('/api/control-calidad/chart-data', [ControlCalidadController::class, 'getChartData'])->middleware('permission:control-calidad');
    Route::post('/api/control-calidad/update-estatus', [ControlCalidadController::class, 'updateEstatus'])->middleware('permission:control-calidad');
    Route::post('/api/control-calidad/update-parametro', [ControlCalidadController::class, 'updateParametro'])->middleware('permission:control-calidad');
    Route::get('/api/control-calidad/historial', [ControlCalidadController::class, 'getHistorial'])->middleware('permission:control-calidad');

    Route::get('/api/visualizacion/columns', [VisualizacionController::class, 'getColumns'])->middleware('permission:visualizacion');
    Route::get('/api/visualizacion/filters', [VisualizacionController::class, 'getFilterData'])->middleware('permission:visualizacion');
    Route::post('/api/visualizacion/filtrar', [VisualizacionController::class, 'filtrarMuestras'])->middleware('permission:visualizacion');
    Route::post('/api/visualizacion/chart-data', [VisualizacionController::class, 'getChartData'])->middleware('permission:visualizacion');

    Route::get('/estaciones-proyecto', [EstacionesProyectoController::class, 'index'])->middleware('permission:estaciones-proyecto');
    Route::get('/api/estaciones-proyecto/map-data', [EstacionesProyectoController::class, 'getMapData'])->middleware('permission:estaciones-proyecto');
    Route::get('/api/estaciones-proyecto/station-history/{id_estacion}', [EstacionesProyectoController::class, 'getStationHistory'])->middleware('permission:estaciones-proyecto');

    Route::resource('users', UserController::class)->middleware('permission:gestion-usuarios');
});
