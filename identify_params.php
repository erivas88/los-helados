<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
use Illuminate\Support\Facades\DB;

$params = DB::table('parametros')
    ->where('enable', 0)
    ->get();

foreach ($params as $p) {
    if (stripos($p->nombre_largo, 'Cond') !== false ||
        stripos($p->nombre_largo, 'CE') !== false ||
        stripos($p->nombre_largo, 'SDT') !== false ||
        stripos($p->nombre_largo, 'Solidos') !== false ||
        stripos($p->nombre_largo, 'pH') !== false) {
        echo $p->id_parametro . " : " . $p->nombre_largo . PHP_EOL;
    }
}
