<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstacionesProyectoController extends Controller
{
    /**
     * Show the main map view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('modules.estaciones_proyecto');
    }

    /**
     * Get all stations with their UTM coordinates for mapping.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMapData()
    {
        try {
            $stations = DB::table('estaciones')
                ->select('id_estacion', 'nombre_estacion', 'utm_este', 'utm_norte', 'clasificacion')
                ->whereNotNull('utm_este')
                ->whereNotNull('utm_norte')
                ->where('utm_este', '>', 0)
                ->get();

            return response()->json($stations);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get approved historical trends for a specific station and top parameters.
     *
     * @param int $id_estacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStationHistory($id_estacion)
    {
        try {
            // Find station name (muestras table often users names)
            $station = DB::table('estaciones')
                ->where('id_estacion', $id_estacion)
                ->first();

            if (!$station) {
                return response()->json(['error' => 'Estación no encontrada.'], 404);
            }

            // Get last rows (approved data)
            $results = DB::table('muestras')
                ->where('estatus', 1)
                ->where('estacion', $station->nombre_estacion)
                ->orderBy('fecha', 'desc')
                ->limit(24) // Last 24 monitorings
                ->get();

            // Also get all dynamic parameters info to parse chart series properly
            $parametros = DB::table('parametros as p')
                ->join('unidades as u', 'u.id_unidad', '=', 'p.id_unidad')
                ->where('p.enable', 0)
                ->select('p.id_parametro', 'p.nombre_largo as nombre', 'u.unidad')
                ->get();

            return response()->json([
                'station_name' => $station->nombre_estacion,
                'data' => $results,
                'parametros' => $parametros
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
