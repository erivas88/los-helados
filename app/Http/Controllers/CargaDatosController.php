<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\ExcelImportService;

class CargaDatosController extends Controller
{
    /**
     * Get Tabulator column definitions for the Carga de Datos module.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getColumns()
    {
        try {
            $columns = $this->createColumns();
            return response()->json($columns);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get data for the filters in the Carga de Datos module.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFilterData()
    {
        try {
            // depositos (reemplaza a sectores)
            $depositos = DB::table('depositos')
                ->select('id_depositos', 'descripcion')
                ->orderBy('descripcion')
                ->get();

            // estaciones
            $estaciones = DB::table('estaciones')
                ->select('id_estacion', 'nombre_estacion', 'clasificacion')
                ->orderBy('nombre_estacion')
                ->get();

            // años distintos de muestras
            $years = DB::table('muestras')
                ->selectRaw('DISTINCT YEAR(fecha) AS years')
                ->whereNotNull('fecha')
                ->orderBy('years', 'desc')
                ->pluck('years');

            // programas
            $programas = DB::table('programas')
                ->select('id_programa', 'nombre_serie')
                ->orderBy('nombre_serie')
                ->get();

            // meses estáticos en español
            $meses = [
                ['id' => 1,  'nombre' => 'Enero'],
                ['id' => 2,  'nombre' => 'Febrero'],
                ['id' => 3,  'nombre' => 'Marzo'],
                ['id' => 4,  'nombre' => 'Abril'],
                ['id' => 5,  'nombre' => 'Mayo'],
                ['id' => 6,  'nombre' => 'Junio'],
                ['id' => 7,  'nombre' => 'Julio'],
                ['id' => 8,  'nombre' => 'Agosto'],
                ['id' => 9,  'nombre' => 'Septiembre'],
                ['id' => 10, 'nombre' => 'Octubre'],
                ['id' => 11, 'nombre' => 'Noviembre'],
                ['id' => 12, 'nombre' => 'Diciembre'],
            ];

            return response()->json([
                'depositos'  => $depositos,
                'estaciones' => $estaciones,
                'years'      => $years,
                'programas'  => $programas,
                'meses'      => $meses,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get stations for a given sector.
     *
     * @param int $id_sector
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEstacionesBySector($id_sector)
    {
        try {
            // La relación es: depositos.clasificacion = estaciones.clasificacion
            $estaciones = DB::table('estaciones')
                ->where('clasificacion', $id_sector)
                ->select('id_estacion', 'nombre_estacion')
                ->orderBy('nombre_estacion')
                ->get();
            return response()->json($estaciones);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Create columns definition for Tabulator.
     *
     * @return array
     */
    private function createColumns(): array
    {
        $columns = [
            [
                'title' => 'Certificado',
                'field' => 'certificado',
                'frozen' => true,
                'hozAlign' => 'center',
                'headerHozAlign' => 'center',
                'width' => 150,
                'headerFilter' => 'input'
            ],
            [
                'title' => 'Fecha',
                'sorter' => 'date',
                'field' => 'fecha',
                'frozen' => true,
                'hozAlign' => 'center',
                'headerHozAlign' => 'center',
                'width' => 150,
                'headerFilter' => 'input',
                'sorterParams' => [
                    'format' => 'yyyy-MM-dd',
                    'alignEmptyValues' => 'top'
                ]
            ],
            [
                'title' => 'Estacion',
                'field' => 'estacion',
                'frozen' => true,
                'hozAlign' => 'center',
                'headerHozAlign' => 'center',
                'width' => 150,
                'headerFilter' => 'input'
            ]
        ];

        // Fetch dynamic columns from the database
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
                    'thousandSeparator' => ',',
                    'decimalSeparator' => ',',
                    'alignEmptyValues' => 'top'
                ]
            ];
        }

        return $columns;
    }

    /**
     * Import Excel file based on control_upload.
     *
     * @param Request $request
     * @param ExcelImportService $excelService
     * @return \Illuminate\Http\JsonResponse
     */
    public function importar(Request $request, ExcelImportService $excelService)
    {
        $filePathAbsolute = null;
        try {
            $request->validate([
                'dataxls' => 'required|file|mimes:xls,xlsx|max:20480',
            ]);

            $file = $request->file('dataxls');
            
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = storage_path('app/temp_excel');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);
            $filePathAbsolute = $destinationPath . '/' . $fileName;

            $data = $excelService->readExcel($filePathAbsolute);
            $reply = $excelService->processRecords($data);

            if (file_exists($filePathAbsolute)) {
                unlink($filePathAbsolute);
            }

            return response()->json($reply);
        } catch (\Exception $e) {
            if ($filePathAbsolute && file_exists($filePathAbsolute)) {
                unlink($filePathAbsolute);
            }
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Filter data for Tabulator
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filtrarMuestras(Request $request)
    {
        try {
            $data = $request->validate([
                'stations' => 'required|array',
                'months' => 'required|array',
                'years' => 'required|array',
                'indicador' => 'required|array',
            ]);

            $stations = $data['stations'];
            $months = $data['months'];
            $years = $data['years'];
            $indicador = $data['indicador'];

            $stationNames = DB::table('estaciones')
                ->whereIn('id_estacion', $stations)
                ->pluck('nombre_estacion')
                ->toArray();

            if (empty($stationNames) || empty($months) || empty($years)) {
                return response()->json([]);
            }

            $query = DB::table('muestras')
                ->where('estatus', '0')
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

            $selects = [
                'id_certificado as certificado',
                DB::raw("DATE_FORMAT(DATE_ADD(fecha, INTERVAL 1 DAY), '%Y-%m-%d') AS fecha"),
                'estacion',
                'estatus'
            ];
            for ($i = 1; $i <= 75; $i++) {
                $selects[] = "parametro_$i";
            }

            $query->select($selects);
            $query->orderBy('estacion')->orderBy('fecha')->orderBy('id_certificado');

            $resultados = $query->get()->map(function ($row, $key) {
                // Add id mapped to row index for unique datatable IDs if needed
                $row->id = $key + 1;
                
                if ($row->estatus === '1') {
                    $row->estatus = '<i class="fa fa-check" aria-hidden="true" style="color: #47a447"></i>';
                }

                foreach ($row as $k => $v) {
                    if ($v === null || $v === '') {
                        $row->$k = '―';
                    }
                }

                return $row;
            });

            return response()->json($resultados);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete selected records from Tabulator.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function eliminarMuestras(Request $request)
    {
        try {
            $data = $request->validate([
                'certificados' => 'required|array|min:1',
            ]);

            DB::table('muestras')
                ->whereIn('id_certificado', $data['certificados'])
                ->delete();

            return response()->json(['message' => 'Muestras eliminadas correctamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
