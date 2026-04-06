<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$params = DB::table('parametros')
    ->where('enable', 0)
    ->where(function($q) {
        $q->where('nombre_largo', 'like', '%pH%')
          ->orWhere('nombre_largo', 'like', '%Cond%')
          ->orWhere('nombre_largo', 'like', '%SDT%')
          ->orWhere('nombre_largo', 'like', '%CE%');
    })
    ->select('id_parametro', 'nombre_largo')
    ->get();

echo json_encode($params);
