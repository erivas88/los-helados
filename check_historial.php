<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
use Illuminate\Support\Facades\DB;

$rows = DB::table('historial_modificaciones')->get();
echo "Historial size: " . count($rows) . "\n";
print_r($rows);
