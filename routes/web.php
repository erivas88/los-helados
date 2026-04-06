<?php

use App\Http\Controllers\CargaDatosController;
use App\Http\Controllers\ControlCalidadController;
use App\Http\Controllers\VisualizacionController;
use App\Http\Controllers\EstacionesProyectoController;
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

    Route::get('/api/control-calidad/columns', [ControlCalidadController::class, 'getColumns']);
    Route::get('/api/control-calidad/filters', [ControlCalidadController::class, 'getFilterData']);
    Route::get('/api/control-calidad/estaciones/{id_sector}', [ControlCalidadController::class, 'getEstacionesBySector']);
    Route::post('/api/control-calidad/filtrar', [ControlCalidadController::class, 'filtrarMuestras']);
    Route::post('/api/control-calidad/eliminar', [ControlCalidadController::class, 'eliminarMuestras']);
    Route::post('/api/control-calidad/chart-data', [ControlCalidadController::class, 'getChartData']);
    Route::post('/api/control-calidad/update-estatus', [ControlCalidadController::class, 'updateEstatus']);
    Route::post('/api/control-calidad/update-parametro', [ControlCalidadController::class, 'updateParametro']);
    Route::get('/api/control-calidad/historial/{certificado}', [ControlCalidadController::class, 'getHistorial']);

    Route::get('/api/visualizacion/columns', [VisualizacionController::class, 'getColumns']);
    Route::get('/api/visualizacion/filters', [VisualizacionController::class, 'getFilterData']);
    Route::post('/api/visualizacion/filtrar', [VisualizacionController::class, 'filtrarMuestras']);
    Route::post('/api/visualizacion/chart-data', [VisualizacionController::class, 'getChartData']);

    Route::get('/estaciones-proyecto', [EstacionesProyectoController::class, 'index']);
    Route::get('/api/estaciones-proyecto/map-data', [EstacionesProyectoController::class, 'getMapData']);
    Route::get('/api/estaciones-proyecto/station-history/{id_estacion}', [EstacionesProyectoController::class, 'getStationHistory']);
});
