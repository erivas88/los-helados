<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisualizacionController extends ControlCalidadController
{
    /**
     * Get columns for Tabulator in Visualization module.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getColumns()
    {
        $columns = [
            [
                'title' => 'Certificado',
                'field' => 'certificado',
                'frozen' => true,
                'hozAlign' => 'center',
                'headerHozAlign' => 'center',
                'width' => 120,
                'headerFilter' => 'input'
            ],
            [
                'title' => 'Fecha',
                'field' => 'fecha',
                'frozen' => true,
                'hozAlign' => 'center',
                'headerHozAlign' => 'center',
                'width' => 120,
                'headerFilter' => 'input'
            ],
            [
                'title' => 'Estacion',
                'field' => 'estacion',
                'frozen' => true,
                'hozAlign' => 'center',
                'headerHozAlign' => 'center',
                'width' => 150,
                'headerFilter' => 'input'
            ],
            [
                'title' => 'Estatus',
                'field' => 'estatus',
                'frozen' => true,
                'hozAlign' => 'center',
                'headerHozAlign' => 'center',
                'width' => 100,
                'formatter' => 'estatusFormatter', 
                'headerFilter' => 'input'
            ]
        ];

        // Fetch dynamic columns from the database (Parametros 1-91)
        $dynamicColumns = DB::table('parametros as p')
            ->join('unidades as u', 'u.id_unidad', '=', 'p.id_unidad')
            ->where('p.enable', 0)
            ->select('p.nombre_largo as nombre', 'p.id_parametro', 'u.unidad')
            ->get();

        foreach ($dynamicColumns as $row) {
            $columns[] = [
                'title' => htmlspecialchars($row->nombre, ENT_QUOTES, 'UTF-8') . " <span style='font-size: x-small'> [" . htmlspecialchars($row->unidad, ENT_QUOTES, 'UTF-8') . "]</span>",
                'field' => "parametro_" . $row->id_parametro,
                'hozAlign' => 'center',
                'headerHozAlign' => 'center',
                'width' => 150,
                'sorter' => 'number',
                'headerFilter' => 'input',
                'sorterParams' => [
                    'thousandSeparator' => '.',
                    'decimalSeparator' => ',',
                    'alignEmptyValues' => 'top'
                ],
                'formatter' => 'paramModifiedFormatter' 
            ];
        }

        return response()->json($columns);
    }

    /**
     * Filter samples for Visualization (only estatus = 1).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filtrarMuestras(Request $request)
    {
        try {
            $stations = $request->input('stations', []);
            $months = $request->input('months', []);
            $years = $request->input('years', []);
            $indicador = $request->input('indicador', []);

            // Mirrored filter logic from ControlCalidadController to avoid 500 errors
            $stationNames = DB::table('estaciones')
                ->whereIn('id_estacion', $stations)
                ->pluck('nombre_estacion')
                ->toArray();

            $query = DB::table('muestras')
                ->where('estatus', 1)
                ->whereIn('estacion', $stationNames);

            $query->where(function ($q) use ($years, $months) {
                foreach ($years as $year) {
                    foreach ($months as $month) {
                        $q->orWhere(function ($subq) use ($year, $month) {
                            $subq->whereYear('fecha', $year)
                                 ->whereMonth('fecha', $month);
                        });
                    }
                }
            });

            if (!empty($indicador)) {
                $columnasPrograma = DB::table('programas')
                    ->whereIn('id_programa', $indicador)
                    ->pluck('columna_programa');

                foreach ($columnasPrograma as $columna) {
                    if (!empty($columna)) {
                        $query->where($columna, '1');
                    }
                }
            }

            // Dynamic columns & flags
            $selects = [
                'id_certificado as certificado',
                DB::raw("DATE_FORMAT(DATE_ADD(fecha, INTERVAL 1 DAY), '%Y-%m-%d') AS fecha"),
                'estacion',
                'estatus'
            ];
            for ($i = 1; $i <= 91; $i++) {
                $selects[] = "parametro_$i";
                $selects[] = "band_edit_$i";
            }

            $query->select($selects);
            $query->orderBy('estacion')->orderBy('fecha');
            
            $data = $query->get()->map(function ($row, $key) {
                $row->id = $key + 1; // Unique ID for Tabulator
                foreach ($row as $k => $v) {
                    if ($v === null || $v === '') {
                        $row->$k = '―';
                    }
                }
                return $row;
            });

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get chart data for Visualization (only estatus = 1).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getChartData(Request $request)
    {
        try {
            $stations = $request->input('stations', []);
            $parametros = $request->input('parametros', []);
            $indicador = $request->input('indicador', []);

            $stationNames = DB::table('estaciones')
                ->whereIn('id_estacion', $stations)
                ->pluck('nombre_estacion')
                ->toArray();

            $query = DB::table('muestras')
                ->where('estatus', 1)
                ->whereIn('estacion', $stationNames);

            if (!empty($indicador)) {
                $columnasPrograma = DB::table('programas')
                    ->whereIn('id_programa', (array)$indicador)
                    ->pluck('columna_programa');

                foreach ($columnasPrograma as $columna) {
                    if (!empty($columna)) {
                        $query->where($columna, '1');
                    }
                }
            }

            $selects = ['id_certificado', 'estacion', DB::raw("DATE_FORMAT(fecha, '%Y-%m-%d') as fecha_label")];
            foreach ($parametros as $pID) {
                $selects[] = "parametro_$pID";
            }

            $raw = $query->select($selects)->orderBy('fecha', 'asc')->get();

            $parametrosInfo = DB::table('parametros as p')
                ->join('unidades as u', 'u.id_unidad', '=', 'p.id_unidad')
                ->whereIn('p.id_parametro', $parametros)
                ->select('p.id_parametro', 'p.nombre_largo', 'u.unidad')
                ->get()
                ->keyBy('id_parametro');

            return response()->json([
                'raw' => $raw,
                'parametros_info' => $parametrosInfo
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
