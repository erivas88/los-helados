<?php
use Illuminate\Support\Facades\DB;

try {
    $stations = ['2']; // Assuming AS-15
    $months = ['8'];
    $years = ['2025'];
    $indicador = ['1'];

    // If ID of AS-15 isn't 2, let's just cheat and look it up
    $st = DB::table('estaciones')->where('nombre_estacion', 'AS-15')->first();
    if($st) $stations = [$st->id_estacion];

    $stationNames = DB::table('estaciones')
        ->whereIn('id_estacion', $stations)
        ->pluck('nombre_estacion')
        ->toArray();

    if (empty($stationNames)) {
        die("No station names found");
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

    echo "SQL:\n" . $query->toSql() . "\n";
    echo "Bindings:\n"; print_r($query->getBindings());

    $resultados = $query->get();
    echo "\nRows found: " . count($resultados) . "\n";
} catch (\Throwable $e) {
    echo "ERROR CATCHED: " . $e->getMessage() . "\n";
}
