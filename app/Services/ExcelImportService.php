<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\DB;
use Exception;

class ExcelImportService
{
    /**
     * Construye un diccionario desde la tabla control_upload.
     * Retorna un arreglo con dos mapeos:
     * - posEx_to_arreglo: Mapea la posición en el Excel al nombre de la regla (arreglos).
     * - arreglo_to_columna: Mapea la regla (arreglos) al nombre de la columna en la BD (columna).
     *
     * @return array
     */
    public function buildDictionary()
    {
        $diccionarios = DB::table('control_upload')
            ->whereNotNull('arreglos')
            ->whereNotNull('pos_ex')
            ->get(['pos_ex', 'arreglos', 'columna']);

        $posExToArray = [];
        $arrayToColumna = [];

        foreach ($diccionarios as $row) {
            $posExToArray[$row->pos_ex] = $row->arreglos;
            $arrayToColumna[$row->arreglos] = $row->columna;
        }
        
        // Ensure ALL required mappings map to a DB column, even those without pos_ex.
        $allColumnsForInsert = DB::table('control_upload')
            ->whereNotNull('arreglos')
            ->get(['arreglos', 'columna']);
            
        foreach ($allColumnsForInsert as $row) {
             $arrayToColumna[$row->arreglos] = $row->columna;
        }

        return [
            'posEx_to_arreglo' => $posExToArray,
            'arreglo_to_columna' => $arrayToColumna
        ];
    }

    /**
     * Lee el archivo Excel y devuelve un arreglo asociativo convertido según el diccionario.
     *
     * @param string $filePath
     * @return array
     * @throws Exception
     */
    public function readExcel(string $filePath)
    {
        try {
            $documento = IOFactory::load($filePath);
            $hoja = $documento->getActiveSheet();
            
            $diccionario = $this->buildDictionary();
            $posExToArray = $diccionario['posEx_to_arreglo'];
            
            $totalFilas = $hoja->getHighestRow();
            $totalColumnasStr = $hoja->getHighestColumn();
            $totalColumnas = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($totalColumnasStr);

            $datosFila = [];
            // Empezar en la fila 2 asumiendo que la fila 1 es la cabecera.
            for ($fila = 2; $fila <= $totalFilas; $fila++) {
                $filaActual = [];
                
                foreach ($posExToArray as $pos => $nombreArreglo) {
                    if ($pos <= $totalColumnas) {
                        $direccionCelda = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($pos) . $fila;
                        $cell = $hoja->getCell($direccionCelda);
                        $valorCelda = $cell->getValue();
                        
                        if (\PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($cell)) {
                            try {
                                $dateObj = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($cell->getValue());
                                $valorCelda = $dateObj->format('Y-m-d');
                            } catch (Exception $e) {
                                try {
                                    $valorCelda = $cell->getFormattedValue();
                                } catch (Exception $e2) {
                                    // Ignore
                                }
                            }
                        }
                        
                        $filaActual[$nombreArreglo] = $valorCelda !== null ? $this->normalizarValorNumerico($valorCelda) : '';
                    } else {
                        $filaActual[$nombreArreglo] = '';
                    }
                }
                
                // Si la estación no está vacía, agregamos la fila.
                if (isset($filaActual['estacion']) && $filaActual['estacion'] != '') {
                    $datosFila[] = $filaActual;
                }
            }
            
            return $this->convertirFechas($datosFila);
            
        } catch (Exception $e) {
            throw new Exception('Error al transferir datos del archivo Excel: ' . $e->getMessage());
        }
    }

    /**
     * Convierte cualquier número (incluida notación científica) a string decimal sin exponencial.
     * Mantiene coma como separador decimal.
     * Respeta prefijo "<".
     * Recorta ceros de la derecha.
     */
    public function normalizarValorNumerico($valor, int $precision = 12): string
    {
        $str = trim((string)$valor);
        if ($str === '') return '';

        $lt = false;
        if ($str[0] === '<') {
            $lt = true;
            $str = ltrim(substr($str, 1)); // quita "<" y espacios
        }

        $std = str_replace(',', '.', $str);

        if (!preg_match('/^[+-]?\d+(?:\.\d+)?(?:[eE][+-]?\d+)?$/', $std)) {
            return ($lt ? '<' : '') . $str;
        }

        $num = (float)$std;
        $fmt = sprintf('%.' . $precision . 'F', $num);

        $fmt = rtrim(rtrim($fmt, '0'), '.');
        $fmt = str_replace('.', ',', $fmt);

        if ($fmt === '' || $fmt === '-0') $fmt = '0';

        return ($lt ? '<' : '') . $fmt;
    }

    private function convertirFechas($datos)
    {
        foreach ($datos as &$fila) {
            if (isset($fila['fecha'])) {
                if (is_numeric($fila['fecha'])) {
                    try {
                        $fechaNumerica = $fila['fecha'];
                        $fechaUnix = ($fechaNumerica - 25569) * 86400;
                        $fila['fecha'] = date('Y-m-d', (int)$fechaUnix);
                    } catch (Exception $e) {
                        $fila['fecha'] = 'Fecha no válida';
                    }
                } else {
                    $textoFecha = trim($fila['fecha']);
                    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $textoFecha)) {
                        // Intentar analizar DD/MM/YYYY o MM/DD/YYYY o DD-MM-YYYY
                        $textoFecha = str_replace('-', '/', $textoFecha);
                        if (preg_match('/^(\d{1,2})\/(\d{1,2})\/(\d{4})$/', $textoFecha, $m)) {
                            // Si el primer parámetro es mayor a 12, seguro es DD/MM/YYYY. 
                            // Si el primer parámetro es menor o igual a 12 y el segundo es > 12, es MM/DD/YYYY.
                            if ($m[1] > 12) {
                                // DD/MM/YYYY
                                $fila['fecha'] = sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]);
                            } elseif ($m[2] > 12) {
                                // MM/DD/YYYY
                                $fila['fecha'] = sprintf('%04d-%02d-%02d', $m[3], $m[1], $m[2]);
                            } else {
                                // Ambiguo, asumimos MM/DD/YYYY porque MS Excel en locale por defecto suele tirar formato americano si es texto. 
                                // O asume DD/MM/YYYY dependiendo de la región. El usuario está enviando 11/20/2025 lo cual es MM/DD/YYYY
                                // O si envían 20-11-2025 es DD/MM/YYYY... Excel genera el output con getFormattedValue.
                                // Pero ya estamos usando excelToDateTimeObject, por lo que este bloque solo atrapará strings puros insertados manualmente.
                                $fila['fecha'] = sprintf('%04d-%02d-%02d', $m[3], $m[2], $m[1]); // Default to DD/MM/YYYY as it's common LATAM
                                // But wait! 11/20/2025 was detected as 11=mes, 20=dia. That's MM/DD/YYYY. 
                                // So we shouldn't fail if we fallback!
                            }
                        } else {
                            try {
                                $fila['fecha'] = \Carbon\Carbon::parse($textoFecha)->format('Y-m-d');
                            } catch (\Exception $e) {
                                // Skip or keep
                            }
                        }
                    }
                }
            }
        }
        return $datos;
    }

    /**
     * Inserta los datos procesados en la base de datos usando Eloquent (DB facade).
     *
     * @param array $records
     * @return array
     */
    public function processRecords($records)
    {
        $insert_positive = 0;
        $insert_negative = 0;
        $rechazos = [];
        $elementos = count($records);

        $diccionario = $this->buildDictionary();
        $arrayToColumna = $diccionario['arreglo_to_columna'];

        foreach ($records as $record) {
            $certificado = $record['certificado'] ?? null;
            $fecha = $record['fecha'] ?? null;
            $estacion = $record['estacion'] ?? null;
            
            if (!$certificado || !$estacion) {
                $insert_negative++;
                $rechazos[] = [
                    'certificado' => $certificado ?? '-', 
                    'fecha' => $fecha ?? '-', 
                    'estacion' => $estacion ?? '-', 
                    'motivo' => 'Faltan datos clave'
                ];
                continue;
            }

            // Validations
            $search = DB::table('muestras')->where('id_certificado', $certificado)->count();
            $pmr = DB::table('estaciones')->where('nombre_estacion', $estacion)->count();

            if ($search > 0) {
                $insert_negative++;
                $rechazos[] = [
                    'certificado' => $certificado, 
                    'fecha' => $fecha, 
                    'estacion' => $estacion, 
                    'motivo' => 'ID ya Fue Ingresado'
                ];
            } elseif ($pmr == 0) {
                $insert_negative++;
                $rechazos[] = [
                    'certificado' => $certificado, 
                    'fecha' => $fecha, 
                    'estacion' => $estacion, 
                    'motivo' => 'Estación no existe'
                ];
            } else {
                $payload = [];
                
                // Mapear cada elemento del Excel al nombre correcto de columna en 'muestras'
                foreach ($arrayToColumna as $keyInArray => $dbColumn) {
                    if (isset($record[$keyInArray])) {
                        $payload[$dbColumn] = $record[$keyInArray];
                    }
                }
                
                $payload['date_up'] = now();
                
                try {
                    DB::table('muestras')->insert($payload);
                    $insert_positive++;
                    $rechazos[] = [
                        'certificado' => $certificado, 
                        'fecha' => $fecha, 
                        'estacion' => $estacion, 
                        'motivo' => 'Ingresado'
                    ];
                } catch (Exception $e) {
                    $insert_negative++;
                    $rechazos[] = [
                        'certificado' => $certificado, 
                        'fecha' => $fecha, 
                        'estacion' => $estacion, 
                        'motivo' => '<p>' . $e->getMessage() . '</p>'
                    ];
                }
            }
        }
        
        return [
            'procesados' => $elementos,
            'ingresados' => $insert_positive,
            'rechazados' => $insert_negative,
            'tabla' => $rechazos,
        ];
    }
}
