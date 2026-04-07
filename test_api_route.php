<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

$cert = "5965-1/2025.2";
$encoded = urlencode($cert);
echo "Encoded: $encoded\n";

$request = \Illuminate\Http\Request::create("/api/control-calidad/historial/$encoded", "GET");
$response = Route::dispatch($request);
echo "Status: " . $response->getStatusCode() . "\n";
echo "Content: " . $response->getContent() . "\n";
