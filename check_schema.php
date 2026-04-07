<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
use Illuminate\Support\Facades\DB;

$columns = DB::select('SHOW COLUMNS FROM muestras');
foreach ($columns as $c) {
    if (strpos($c->Field, 'parametro_') !== false || strpos($c->Field, 'band_edit_') !== false) {
        // do nothing
    } else {
        echo $c->Field . " (" . $c->Type . ")\n";
    }
}
$first = DB::table('muestras')->first();
print_r($first);
