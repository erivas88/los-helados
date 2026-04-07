<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
use Illuminate\Support\Facades\DB;
$muestras = DB::table('muestras')->first();
$certificado = $muestras->id_certificado;
$val_ant = $muestras->parametro_1;
DB::table('muestras')->where('id_certificado', $certificado)->update(['parametro_1' => '999', 'band_edit_1' => 1]);
$muestras_after = DB::table('muestras')->where('id_certificado', $certificado)->first();
echo "Ant: $val_ant, Nuevo: {$muestras_after->parametro_1}\n";

// restore
DB::table('muestras')->where('id_certificado', $certificado)->update(['parametro_1' => $val_ant, 'band_edit_1' => 0]);
